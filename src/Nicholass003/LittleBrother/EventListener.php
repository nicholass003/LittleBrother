<?php

/*
 * Copyright (c) 2024 - present nicholass003
 *        _      _           _                ___   ___ ____
 *       (_)    | |         | |              / _ \ / _ \___ \
 *  _ __  _  ___| |__   ___ | | __ _ ___ ___| | | | | | |__) |
 * | '_ \| |/ __| '_ \ / _ \| |/ _` / __/ __| | | | | | |__ <
 * | | | | | (__| | | | (_) | | (_| \__ \__ \ |_| | |_| |__) |
 * |_| |_|_|\___|_| |_|\___/|_|\__,_|___/___/\___/ \___/____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  nicholass003
 * @link    https://github.com/nicholass003/
 *
 *
 */

declare(strict_types=1);

namespace Nicholass003\LittleBrother;

use Nicholass003\LittleBrother\Auth\LoginProcessor;
use Nicholass003\LittleBrother\Protocol\PacketSender;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\protocol\RequestNetworkSettingsPacket;
use pocketmine\network\mcpe\protocol\ResourcePackChunkDataPacket;
use function in_array;

class EventListener implements Listener{

	/** @var \ReflectionMethod|null Cached reflection for NetworkSession::flushGamePacketQueue */
	private static ?\ReflectionMethod $flushMethod = null;

	public function __construct(
		private LittleBrother $plugin
	){}

	public function onDataPacketReceive(DataPacketReceiveEvent $event) : void{
		$packet = $event->getPacket();
		$session = $event->getOrigin();
		Debugger::debug("Receive " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);
		if($packet instanceof LoginPacket){
			$event->cancel();
			try{
				$result = LoginProcessor::process($session, $packet);
				LoginProcessor::complete($session, $result);
			}catch(\Throwable $e){
				$session->disconnect("Login failed: " . $e->getMessage());
			}
			return;
		}

		if(!($packet instanceof RequestNetworkSettingsPacket)) return;

		$protocolVersion = $packet->getProtocolVersion();

		if(!in_array($protocolVersion, ProtocolVersion::SUPPORTED_PROTOCOLS, true)) return;

		$this->plugin->getProtocolStorage()->set($session, $protocolVersion);

		if($protocolVersion !== ProtocolInfo::CURRENT_PROTOCOL){
			static $protocolVersionProp = null;
			if($protocolVersionProp === null){
				$ref = new \ReflectionClass($packet);
				$protocolVersionProp = $ref->getProperty('protocolVersion');
				$protocolVersionProp->setAccessible(true);
			}
			$protocolVersionProp->setValue($packet, ProtocolInfo::CURRENT_PROTOCOL);
			$ref = new \ReflectionClass($session);
			$senderProp = $ref->getProperty('sender');
			$senderProp->setAccessible(true);

			$oldSender = $senderProp->getValue($session);

			$newSender = new PacketSender(
				$oldSender,
				$session,
				$this->plugin->getPacketBatchTranslator(),
				$protocolVersion
			);
			$senderProp->setValue($session, $newSender);
		}
	}

	public function onDataPacketSend(DataPacketSendEvent $event) : void{
		$packets = $event->getPackets();
		$targets = $event->getTargets();
		$storage = $this->plugin->getProtocolStorage();

		foreach($packets as $packet){
			if($packet instanceof ResourcePackChunkDataPacket){
				return;
			}
		}

		$hasOldClient = true;
		foreach($targets as $target){
			$protocol = $storage->get($target);
			if($protocol !== null && $protocol !== ProtocolInfo::CURRENT_PROTOCOL){
				$hasOldClient = true;
				break;
			}
		}
		if(!$hasOldClient) return;

		$event->cancel();

		$writer = new ByteBufferWriter();

		foreach($packets as $packet){
			Debugger::debug("Sending " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);

			$writer->clear();
			$buffer = NetworkSession::encodePacketTimed($writer, $packet);

			foreach($targets as $target){
				$target->addToSendBuffer($buffer);
				$this->flushSession($target);
			}
		}
	}

	public function onPlayerQuit(PlayerQuitEvent $event) : void{
		$session = $event->getPlayer()->getNetworkSession();
		$this->plugin->getProtocolStorage()->remove($session);
	}

	private function flushSession(NetworkSession $session) : void{
		if(self::$flushMethod === null){
			$ref = new \ReflectionClass(NetworkSession::class);
			self::$flushMethod = $ref->getMethod('flushGamePacketQueue');
			self::$flushMethod->setAccessible(true);
		}
		self::$flushMethod->invoke($session);
	}
}