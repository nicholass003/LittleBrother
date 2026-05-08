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
use function json_decode;
use function json_encode;
use function strlen;

class EventListener implements Listener{

	/** @var \ReflectionMethod|null Cached reflection for NetworkSession::flushGamePacketQueue */
	private static ?\ReflectionMethod $flushMethod = null;

	/** @var \ReflectionProperty|null Cached reflection for NetworkSession::$packetPool */
	private static ?\ReflectionProperty $packetPoolProp = null;

	public function __construct(
		private LittleBrother $plugin
	){}

	public function onDataPacketReceive(DataPacketReceiveEvent $event) : void{
		$packet = $event->getPacket();
		$session = $event->getOrigin();
		Debugger::debug("Receive " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);
		// HACK: force add missing Certificate field to authInfoJson
		if($packet instanceof LoginPacket){
			$authInfo = json_decode($packet->authInfoJson, true);
			if(!isset($authInfo["Certificate"])){
				$authInfo["Certificate"] = "";
			}
			$packet->authInfoJson = json_encode($authInfo);
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
		$cache = $this->plugin->getCache();

		foreach($packets as $packet){
			if($packet instanceof ResourcePackChunkDataPacket){
				return;
			}
		}

		$hasOldClient = false;
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

			$nativeTargets = [];

			foreach($targets as $target){
				$protocol = $storage->get($target);

				if($protocol === null || $protocol === ProtocolInfo::CURRENT_PROTOCOL){
					$nativeTargets[] = $target;
					continue;
				}

				if(!in_array($protocol, ProtocolVersion::SUPPORTED_PROTOCOLS, true)){
					$nativeTargets[] = $target;
					continue;
				}

				$translated = $cache->get($protocol, $buffer);
				if($translated === null){
					try{
						$result = $this->plugin->getTranslator()->translateOutbound($protocol, $buffer);
					}catch(\Throwable $e){
						Debugger::debug("Translator error in packet " . $packet->getName());
						Debugger::debug($e->getMessage());
						continue;
					}
					if($result === null){
						Debugger::debug("Drop for old client: " . $packet->getName());
						continue;
					}
					$translated = $result;
					Debugger::debug("Packet " . $packet->getName() .
						" size before: " . strlen($buffer) .
						" after: " . strlen($translated), $packet instanceof PlayerAuthInputPacket);
					$cache->set($protocol, $buffer, $translated);
				}
				Debugger::debug("Translate " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);
				$target->addToSendBuffer($translated);
				$this->plugin->getPacketBatchTranslator()->setBypass(true);
				$this->flushSession($target);
				$this->plugin->getPacketBatchTranslator()->setBypass(false);
			}

			if(!empty($nativeTargets)){
				foreach($nativeTargets as $nativeTarget){
					$nativeTarget->addToSendBuffer($buffer);
					$this->plugin->getPacketBatchTranslator()->setBypass(true);
					$this->flushSession($nativeTarget);
					$this->plugin->getPacketBatchTranslator()->setBypass(false);
				}
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