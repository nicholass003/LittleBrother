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

use Nicholass003\LittleBrother\Convert\Block\ChunkTranslator;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\DataPacketDecodeEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\LevelChunkPacket;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\protocol\RequestNetworkSettingsPacket;
use function in_array;
use function strlen;
use const PHP_EOL;

class EventListener implements Listener{

	// Cached reflection for flushGamePacketQueue — private method at NetworkSession
	private static ?\ReflectionMethod $flushMethod = null;

	// Cached reflection for NetworkSession::$packetPool
	private static ?\ReflectionProperty $packetPoolProp = null;

	public function __construct(
		private LittleBrother $plugin
	){}

	public function onDataPacketReceive(DataPacketReceiveEvent $event) : void{
		$packet = $event->getPacket();
		$session = $event->getOrigin();
		Debugger::debug("Receive " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);

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
		}
	}

	public function onDataPacketSend(DataPacketSendEvent $event) : void{
		$packets = $event->getPackets();
		$targets = $event->getTargets();
		$storage = $this->plugin->getProtocolStorage();
		$cache = $this->plugin->getCache();
		$chunkTr = $this->plugin->getChunkTranslator();

		$hasOldClient = false;
		foreach($targets as $target){
			$protocol = $storage->get($target);
			if($protocol !== null && $protocol !== ProtocolInfo::CURRENT_PROTOCOL){
				$hasOldClient = true;
				break;
			}
		}
		if(!$hasOldClient) return;

		$writer = new ByteBufferWriter();
		$nonTranslated = [];

		foreach($packets as $packet){
			Debugger::debug("Sending " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);

			$writer->clear();
			$buffer = NetworkSession::encodePacketTimed($writer, $packet);

			foreach($targets as $target){
				$protocol = $storage->get($target);

				if($protocol === null || $protocol === ProtocolInfo::CURRENT_PROTOCOL){
					$nonTranslated[] = $packet;
					continue;
				}

				if(!in_array($protocol, ProtocolVersion::SUPPORTED_PROTOCOLS, true)){
					$nonTranslated[] = $packet;
					continue;
				}

				if($packet instanceof LevelChunkPacket){
					$translated = $this->translateLevelChunk($packet, $protocol, $chunkTr);
				} else {
					$translated = $cache->get($protocol, $buffer);
					if($translated === null){
						try{
							$result = $this->plugin->getTranslator()->translateOutbound($protocol, $buffer);
						}catch(\Throwable $e){
							echo "Translator error in packet " . $packet->getName() . PHP_EOL;
							echo $e->getMessage() . PHP_EOL;
							throw $e;
						}
						if($result === null){
							continue;
						}
						$translated = $result;
						Debugger::debug("Packet " . $packet->getName() .
							" size before: " . strlen($buffer) .
							" after: " . strlen($translated), $packet instanceof PlayerAuthInputPacket);
						$cache->set($protocol, $buffer, $translated);
					}
				}

				Debugger::debug("Translate " . $packet->getName(), $packet instanceof PlayerAuthInputPacket);
				$target->addToSendBuffer($translated);
				$this->flushSession($target);
			}
		}

		$event->setPackets($nonTranslated);
		foreach($event->getPackets() as $_p){
			Debugger::debug("NON TRANSALTED PACKET : " . $_p->getName(), $packet instanceof PlayerAuthInputPacket);
		}
	}

	public function onPlayerQuit(PlayerQuitEvent $event) : void{
		$session = $event->getPlayer()->getNetworkSession();
		$this->plugin->getProtocolStorage()->remove($session);
	}

	public function onDataPacketDecode(DataPacketDecodeEvent $event) : void{
		$packetId = $event->getPacketId();
		$session = $event->getOrigin();
		$storage = $this->plugin->getProtocolStorage();
		$protocol = $storage->get($session);

		Debugger::debug('Packet Id : ' . $packetId,
			$packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);

		if($protocol === null || $protocol === ProtocolInfo::CURRENT_PROTOCOL) return;
		if(!in_array($protocol, ProtocolVersion::SUPPORTED_PROTOCOLS, true)) return;

		if($this->plugin->getTranslator()->getManualRegistry()->get($packetId) === null) return;

		$originalBuffer = $event->getPacketBuffer();
		$translated = $this->plugin->getTranslator()->translateInbound($protocol, $originalBuffer);

		if($translated === null || $translated === $originalBuffer) return;

		$event->cancel();

		if(self::$packetPoolProp === null){
			$ref = new \ReflectionClass(NetworkSession::class);
			self::$packetPoolProp = $ref->getProperty('packetPool');
			self::$packetPoolProp->setAccessible(true);
		}
		/** @var \pocketmine\network\mcpe\protocol\PacketPool $pool */
		$pool = self::$packetPoolProp->getValue($session);

		$packet = $pool->getPacket($translated);
		if($packet === null){
			Debugger::debug("Unknown packet after translation: packetId=" . $packetId);
			return;
		}

		try{
			$reader = new ByteBufferReader($translated);
			$packet->decode($reader);
		}catch(\pocketmine\network\mcpe\protocol\PacketDecodeException $e){
			Debugger::debug("Packet decode failed after translation: " . $e->getMessage());
			return;
		}

		if(DataPacketReceiveEvent::hasHandlers()){
			$receiveEv = new DataPacketReceiveEvent($session, $packet);
			$receiveEv->call();
			if($receiveEv->isCancelled()) return;
		}

		$handler = $session->getHandler();
		if($handler !== null){
			$packet->handle($handler);
		}
	}

	private function translateLevelChunk(
		LevelChunkPacket $packet,
		int $clientProtocol,
		ChunkTranslator $chunkTranslator
	) : string{
		$originalPayload = $packet->getExtraPayload();
		if($originalPayload === ''){
			$w = new ByteBufferWriter();
			return NetworkSession::encodePacketTimed($w, $packet);
		}
		$translatedPayload = $chunkTranslator->translateChunkOutbound($clientProtocol, $originalPayload);
		$translatedPacket = LevelChunkPacket::create(
			$packet->getChunkPosition(),
			$packet->getDimensionId(),
			$packet->getSubChunkCount(),
			$packet->isClientSubChunkRequestEnabled(),
			$packet->getUsedBlobHashes(),
			$translatedPayload
		);
		$w = new ByteBufferWriter();
		return NetworkSession::encodePacketTimed($w, $translatedPacket);
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