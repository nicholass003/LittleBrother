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

namespace Nicholass003\LittleBrother\Protocol\Translator;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Axiom;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\AddItemActorPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\AddPlayerPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\InventoryContentPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\InventoryTransactionPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ItemRegistryPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LevelChunkPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LevelEventPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LevelSoundEventPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\MobArmorEquipmentPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\MobEquipmentPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\PacketIds;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateBlockPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateBlockSyncedPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use Nicholass003\LittleBrother\LittleBrother;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\AddItemActorTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\AddPlayerTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\InventoryContentTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\InventorySlotTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\InventoryTransactionTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\ItemRegistryTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\LevelChunkRuntimeHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\LevelEventPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\LevelSoundEventPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\MobArmorEquipmentTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\MobEquipmentTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateBlockSyncedTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateBlockTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateSubChunkBlocksTranslationHandler;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\utils\TextFormat;
use function in_array;
use function is_int;

final class PacketTranslator{

	/** @var array<int, RuntimePacketHandler> */
	private array $packetHandlers = [];

	public function __construct(
		private LittleBrother $plugin
	){
		$this->registerHandlers();
	}

	private function registerHandlers() : void{
		$blockMapper = $this->plugin->getRuntimeBlockMapper();
		$itemMapper = $this->plugin->getItemRuntimeIdMapper();
		$chunkTranslator = $this->plugin->getChunkTranslator();

		$this->packetHandlers[AddItemActorPacket::ID] = new AddItemActorTranslationHandler($blockMapper);
		$this->packetHandlers[AddPlayerPacket::ID] = new AddPlayerTranslationHandler($blockMapper);
		$this->packetHandlers[InventoryContentPacket::ID] = new InventoryContentTranslationHandler($blockMapper);
		$this->packetHandlers[InventorySlotPacket::ID] = new InventorySlotTranslationHandler($blockMapper);
		$this->packetHandlers[InventoryTransactionPacket::ID] = new InventoryTransactionTranslationHandler($blockMapper);
		$this->packetHandlers[ItemRegistryPacket::ID] = new ItemRegistryTranslationHandler($itemMapper);
		$this->packetHandlers[MobArmorEquipmentPacket::ID] = new MobArmorEquipmentTranslationHandler($blockMapper);
		$this->packetHandlers[MobEquipmentPacket::ID] = new MobEquipmentTranslationHandler($blockMapper);

		$this->packetHandlers[LevelEventPacket::ID] = new LevelEventPacketHandler($blockMapper);
		$this->packetHandlers[LevelSoundEventPacket::ID] = new LevelSoundEventPacketHandler($blockMapper);
		$this->packetHandlers[UpdateBlockPacket::ID] = new UpdateBlockTranslationHandler($blockMapper);
		$this->packetHandlers[UpdateBlockSyncedPacket::ID] = new UpdateBlockSyncedTranslationHandler($blockMapper);
		$this->packetHandlers[UpdateSubChunkBlocksPacket::ID] = new UpdateSubChunkBlocksTranslationHandler($blockMapper);

		$this->packetHandlers[LevelChunkPacket::ID] = new LevelChunkRuntimeHandler($chunkTranslator);
	}

	public function translateInbound(int $protocol, string $payload) : ?string{
		$builderSource = Axiom::for($protocol);
		$builderTarget = Axiom::for(ProtocolInfo::CURRENT_PROTOCOL);

		$reader = new ByteBufferReader($payload);
		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;

		if($this->shouldBypass($packetId)){
			$this->logPacket("IN ", $protocol, $packetId, "bypassed");
			return $payload;
		}

		$this->logPacket("IN ", $protocol, $packetId, "translating...");

		try{
			$codecSource = $builderSource->get($packetId);
			$packet = $codecSource->decode($reader, $builderSource->getCodecType());
		}catch(\Throwable $e){
			// Silent fallback: return original payload if decoding fails
			return $payload;
		}

		if(isset($this->packetHandlers[$packetId])){
			try{
				$this->packetHandlers[$packetId]->translate($protocol, $packet, true);
			}catch(\Throwable $e){
				// Ignore handler errors
			}
		}

		try{
			$codecTarget = $builderTarget->get($packetId);
			$writer = new ByteBufferWriter();
			VarInt::writeUnsignedInt($writer, $packetId);
			$codecTarget->encode($writer, $packet, $builderTarget->getCodecType());
			return $writer->getData();
		}catch(\Throwable $e){
			return null;
		}
	}

	public function translateOutbound(int $protocol, string $payload) : ?string{
		$builderSource = Axiom::for(ProtocolInfo::CURRENT_PROTOCOL);
		$builderTarget = Axiom::for($protocol);

		$reader = new ByteBufferReader($payload);
		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;

		if($this->shouldBypass($packetId)){
			$this->logPacket("OUT", $protocol, $packetId, "bypassed");
			return $payload;
		}

		$this->logPacket("OUT", $protocol, $packetId, "translating...");

		try{
			$codecSource = $builderSource->get($packetId);
			$packet = $codecSource->decode($reader, $builderSource->getCodecType());
		}catch(\Throwable $e){
			// Silent fallback: return original payload if decoding fails
			return $payload;
		}

		if(isset($this->packetHandlers[$packetId])){
			try{
				$this->packetHandlers[$packetId]->translate($protocol, $packet, false);
			}catch(\Throwable $e){
				// Ignore handler errors
			}
		}

		try{
			$codecTarget = $builderTarget->get($packetId);
			$writer = new ByteBufferWriter();
			VarInt::writeUnsignedInt($writer, $packetId);
			$codecTarget->encode($writer, $packet, $builderTarget->getCodecType());
			return $writer->getData();
		}catch(\Throwable $e){
			return null;
		}
	}

	private function logPacket(string $direction, int $protocol, int $packetId, string $extra) : void{
		$name = $this->getPacketName($packetId);
		Debugger::debug(TextFormat::GRAY . "  {$direction} [{$protocol}] ID:{$packetId} ({$name}) {$extra}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT);
	}

	private function getPacketName(int $pid) : string{
		static $map = null;
		if($map === null){
			$map = [];
			$ref = new \ReflectionClass(PacketIds::class);
			foreach($ref->getConstants() as $name => $value){
				if(is_int($value)){
					$map[$value] = $name;
				}
			}
		}
		return $map[$pid] ?? "UNKNOWN";
	}

	private function shouldBypass(int $packetId) : bool{
		return in_array($packetId, [], true);
	}
}