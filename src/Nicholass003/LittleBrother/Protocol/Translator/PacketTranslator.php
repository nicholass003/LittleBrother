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

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Axiom;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\AddActorPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\AddItemActorPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\AddPlayerPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\CreativeContentPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\InventoryContentPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\InventoryTransactionPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\ItemRegistryPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\LevelChunkPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\LevelEventPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\LevelSoundEventPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\MobArmorEquipmentPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\MobEquipmentPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\PacketIds;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\UpdateBlockPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\UpdateBlockSyncedPacket;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use Nicholass003\LittleBrother\LittleBrother;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\AddActorTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\AddItemActorTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\AddPlayerTranslationHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\CreativeContentTranslationHandler;
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
use function base64_encode;
use function bin2hex;
use function get_debug_type;
use function in_array;
use function is_int;
use function strlen;

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

		$this->packetHandlers[AddActorPacket::ID] = new AddActorTranslationHandler($blockMapper);
		$this->packetHandlers[AddItemActorPacket::ID] = new AddItemActorTranslationHandler($blockMapper);
		$this->packetHandlers[AddPlayerPacket::ID] = new AddPlayerTranslationHandler($blockMapper);
		$this->packetHandlers[CreativeContentPacket::ID] = new CreativeContentTranslationHandler($blockMapper);
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

		$payloadLength = strlen($payload);

		Debugger::debug("[STRICT][INBOUND] Raw payload length: {$payloadLength}");
		Debugger::log("[STRICT][INBOUND] Raw payload hex: " . bin2hex($payload));

		$reader = new ByteBufferReader($payload);

		try{
			$header = VarInt::readUnsignedInt($reader);
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Failed reading packet header: " . $e->getMessage());
			Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Payload(base64): " . base64_encode($payload));
			return null;
		}

		$packetId = $header & DataPacket::PID_MASK;

		Debugger::debug("[STRICT][INBOUND] Packet ID: {$packetId}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
		Debugger::debug("[STRICT][INBOUND] Packet name: " . $this->getPacketName($packetId), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
		Debugger::debug("[STRICT][INBOUND] Remaining bytes before decode: " . $reader->getUnreadLength(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

		if($this->shouldBypass($packetId)){
			$this->logPacket("IN ", $protocol, $packetId, "bypassed");
			return $payload;
		}

		$this->logPacket("IN ", $protocol, $packetId, "translating...");

		try{
			$codecSource = $builderSource->get($packetId);

			Debugger::debug("[STRICT][INBOUND] Codec source: " . get_debug_type($codecSource), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			$packet = $codecSource->decode($reader, $builderSource->getCodecType());

			Debugger::debug("[STRICT][INBOUND] Decode success: " . get_debug_type($packet), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug("[STRICT][INBOUND] Remaining bytes after decode: " . $reader->getUnreadLength(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			if($reader->getUnreadLength() > 0){
				Debugger::debug(TextFormat::YELLOW . "[STRICT][INBOUND] WARNING: Packet not fully consumed for {$packetId}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
				Debugger::log(TextFormat::YELLOW . "[STRICT][INBOUND] Remaining hex: " . bin2hex($reader->readByteArray($reader->getUnreadLength())), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[ERROR] Inbound decode failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Payload(base64): " . base64_encode($payload), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			return $payload;
		}

		if(isset($this->packetHandlers[$packetId])){
			try{
				Debugger::debug("[STRICT][INBOUND] Handler: " . get_debug_type($this->packetHandlers[$packetId]), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

				$this->packetHandlers[$packetId]->translate($protocol, $packet, true);

				Debugger::debug("[STRICT][INBOUND] Handler translation success", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}catch(\Throwable $e){
				Debugger::debug(TextFormat::RED . "[ERROR] Inbound handler failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
				Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Handler trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}
		}

		try{
			$codecTarget = $builderTarget->get($packetId);

			Debugger::debug("[STRICT][INBOUND] Codec target: " . get_debug_type($codecTarget), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			$writer = new ByteBufferWriter();
			VarInt::writeUnsignedInt($writer, $packetId);
			$codecTarget->encode($writer, $packet, $builderTarget->getCodecType());

			$data = $writer->getData();

			Debugger::debug("[STRICT][INBOUND] Encoded length: " . strlen($data), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::log("[STRICT][INBOUND] Encoded hex: " . bin2hex($data), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			return $data;
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[ERROR] Inbound encode failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][INBOUND] Encode trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			return null;
		}
	}

	public function translateOutbound(int $protocol, string $payload) : ?string{
		$builderSource = Axiom::for(ProtocolInfo::CURRENT_PROTOCOL);
		$builderTarget = Axiom::for($protocol);

		$payloadLength = strlen($payload);

		Debugger::debug("[STRICT][OUTBOUND] Raw payload length: {$payloadLength}");
		Debugger::log("[STRICT][OUTBOUND] Raw payload hex: " . bin2hex($payload));

		$reader = new ByteBufferReader($payload);

		try{
			$header = VarInt::readUnsignedInt($reader);
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[STRICT][OUTBOUND] Failed reading packet header: " . $e->getMessage());
			Debugger::log(TextFormat::RED . "[STRICT][OUTBOUND] Payload(base64): " . base64_encode($payload));
			return null;
		}

		$packetId = $header & DataPacket::PID_MASK;

		Debugger::debug("[STRICT][OUTBOUND] Packet ID: {$packetId}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
		Debugger::debug("[STRICT][OUTBOUND] Packet name: " . $this->getPacketName($packetId), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
		Debugger::debug("[STRICT][OUTBOUND] Remaining bytes before decode: " . $reader->getUnreadLength(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

		if($this->shouldBypass($packetId)){
			$this->logPacket("OUT", $protocol, $packetId, "bypassed");
			return $payload;
		}

		$this->logPacket("OUT", $protocol, $packetId, "translating...");

		try{
			$codecSource = $builderSource->get($packetId);

			Debugger::debug("[STRICT][OUTBOUND] Codec source: " . get_debug_type($codecSource), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			$packet = $codecSource->decode($reader, $builderSource->getCodecType());

			Debugger::debug("[STRICT][OUTBOUND] Decode success: " . get_debug_type($packet), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug("[STRICT][OUTBOUND] Remaining bytes after decode: " . $reader->getUnreadLength(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			if($reader->getUnreadLength() > 0){
				Debugger::debug(TextFormat::YELLOW . "[STRICT][OUTBOUND] WARNING: Packet not fully consumed for {$packetId}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
				Debugger::log(TextFormat::YELLOW . "[STRICT][OUTBOUND] Remaining hex: " . bin2hex($reader->readByteArray($reader->getUnreadLength())), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[ERROR] Outbound decode failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][OUTBOUND] Trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][OUTBOUND] Payload(base64): " . base64_encode($payload), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			return $payload;
		}

		if(isset($this->packetHandlers[$packetId])){
			try{
				Debugger::debug("[STRICT][OUTBOUND] Handler: " . get_debug_type($this->packetHandlers[$packetId]), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

				$this->packetHandlers[$packetId]->translate($protocol, $packet, false);

				Debugger::debug("[STRICT][OUTBOUND] Handler translation success", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}catch(\Throwable $e){
				Debugger::debug(TextFormat::RED . "[ERROR] Outbound handler failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
				Debugger::debug(TextFormat::RED . "[STRICT][OUTBOUND] Handler trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			}
		}

		try{
			$codecTarget = $builderTarget->get($packetId);

			Debugger::debug("[STRICT][OUTBOUND] Codec target: " . get_debug_type($codecTarget), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			$writer = new ByteBufferWriter();
			VarInt::writeUnsignedInt($writer, $packetId);
			$codecTarget->encode($writer, $packet, $builderTarget->getCodecType());

			$data = $writer->getData();

			Debugger::debug("[STRICT][OUTBOUND] Encoded length: " . strlen($data), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::log("[STRICT][OUTBOUND] Encoded hex: " . bin2hex($data), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);

			return $data;
		}catch(\Throwable $e){
			Debugger::debug(TextFormat::RED . "[ERROR] Outbound encode failed for packet ID {$packetId} (protocol {$protocol}): " . $e->getMessage(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			Debugger::debug(TextFormat::RED . "[STRICT][OUTBOUND] Encode trace: " . $e->getTraceAsString(), ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
			return null;
		}
	}

	private function logPacket(string $direction, int $protocol, int $packetId, string $extra) : void{
		$name = $this->getPacketName($packetId);
		Debugger::debug(TextFormat::GRAY . "  {$direction} [{$protocol}] ID:{$packetId} ({$name}) {$extra}", ignore: $packetId === PacketIds::PLAYER_AUTH_INPUT || $packetId === PacketIds::LEVEL_CHUNK);
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