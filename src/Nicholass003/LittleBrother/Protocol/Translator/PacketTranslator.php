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

use Nicholass003\LittleBrother\LittleBrother;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\AnimatePacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\CraftingDataPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\InteractPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\ItemStackResponsePacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\MovePlayerPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\PlayerAuthInputPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\PlayerListPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\StartGamePacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\TextPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\LevelChunkRuntimeHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateBlockRuntimeHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateBlockSyncedRuntimeHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\UpdateSubChunkBlocksRuntimeHandler;
use Nicholass003\LittleBrother\Protocol\Translator\v729\Packet\InventoryTransactionPacketHandler;
use Nicholass003\LittleBrother\Schema\SchemaRegistry;
use Nicholass003\LittleBrother\Schema\SchemaTranslator;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use function bin2hex;
use function strlen;

final class PacketTranslator{

	public function __construct(
		private SchemaTranslator $schema,
		private ManualPacketRegistry $manual,
		private RuntimePacketRegistry $runtime,
		private LittleBrother $plugin
	){
		$this->registerRuntimePacketHandlers();
		$this->registerHandlers();
	}

	private function registerRuntimePacketHandlers() : void{
		$registry = $this->runtime;
		$registry->register(ProtocolInfo::LEVEL_CHUNK_PACKET, new LevelChunkRuntimeHandler($this->plugin->getChunkTranslator()));
		$registry->register(ProtocolInfo::UPDATE_BLOCK_PACKET, new UpdateBlockRuntimeHandler($this->plugin->getRuntimeBlockMapper()));
		$registry->register(ProtocolInfo::UPDATE_SUB_CHUNK_BLOCKS_PACKET, new UpdateSubChunkBlocksRuntimeHandler($this->plugin->getRuntimeBlockMapper()));
		$registry->register(ProtocolInfo::UPDATE_BLOCK_SYNCED_PACKET, new UpdateBlockSyncedRuntimeHandler($this->plugin->getRuntimeBlockMapper()));
	}

	private function registerHandlers() : void{
		$registry = $this->manual;
		$registry->register(ProtocolInfo::CRAFTING_DATA_PACKET, new CraftingDataPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::PLAYER_LIST_PACKET, new PlayerListPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::START_GAME_PACKET, new StartGamePacketHandler($this->plugin));
		$registry->register(ProtocolInfo::TEXT_PACKET, new TextPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::PLAYER_AUTH_INPUT_PACKET, new PlayerAuthInputPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::MOVE_PLAYER_PACKET, new MovePlayerPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::ITEM_STACK_RESPONSE_PACKET, new ItemStackResponsePacketHandler($this->plugin));
		$registry->register(ProtocolInfo::INTERACT_PACKET, new InteractPacketHandler($this->plugin));
		$registry->register(ProtocolInfo::ANIMATE_PACKET, new AnimatePacketHandler($this->plugin));
		$registry->register(ProtocolInfo::INVENTORY_TRANSACTION_PACKET, new InventoryTransactionPacketHandler($this->plugin->getTypeRegistryFactory()->getTypeRegistry()), batchOnly: true);
	}

	public function translateInbound(int $protocol, string $payload) : ?string{
		$reader = new ByteBufferReader($payload);

		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;
		Debugger::log("Packet ID: " . $packetId);
		Debugger::log("Payload HEX: " . bin2hex($payload));
		Debugger::log("Payload LEN: " . strlen($payload));

		$body = $reader->getUnreadLength() > 0
			? $reader->readByteArray($reader->getUnreadLength())
			: "";

		$runtime = $this->runtime->get($packetId);

		if($runtime !== null){
			$body = $runtime->translateInbound($protocol, $body);
		}

		$result = $this->schema->translateInbound(
			$protocol,
			$packetId,
			new ByteBufferReader($body)
		);

		if($result === null){
			return null;
		}

		if($result === false){

			$handler = $this->manual->get($packetId);

			if($handler !== null){
				$result = $handler->translateInbound(
					$protocol,
					new ByteBufferReader($body)
				);
			}else{
				$result = $body;
			}
		}

		$writer = new ByteBufferWriter();

		VarInt::writeUnsignedInt($writer, $header);

		if($result !== ""){
			$writer->writeByteArray($result);
		}

		return $writer->getData();
	}

	public function translateOutbound(int $protocol, string $payload) : ?string{
		$reader = new ByteBufferReader($payload);

		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;
		Debugger::log("Packet ID: " . $packetId);
		Debugger::log("Payload HEX: " . bin2hex($payload));
		Debugger::log("Payload LEN: " . strlen($payload));

		$body = $reader->getUnreadLength() > 0
			? $reader->readByteArray($reader->getUnreadLength())
			: "";

		$runtime = $this->runtime->get($packetId);

		if($runtime !== null){
			$body = $runtime->translateOutbound($protocol, $body);
		}

		$result = $this->schema->translateOutbound(
			$protocol,
			$packetId,
			new ByteBufferReader($body)
		);

		if($result === null){
			return null;
		}

		if($result === false){

			$handler = $this->manual->get($packetId);

			if($handler !== null){
				$result = $handler->translateOutbound(
					$protocol,
					new ByteBufferReader($body)
				);
			}else{
				$result = $body;
			}
		}

		$writer = new ByteBufferWriter();

		VarInt::writeUnsignedInt($writer, $header);

		if($result !== ""){
			$writer->writeByteArray($result);
		}

		return $writer->getData();
	}

	public function getManualRegistry() : ManualPacketRegistry{
		return $this->manual;
	}

	public function getSchemaRegistry() : SchemaRegistry{
		return $this->schema->getSchemaRegistry();
	}

	public function getPlugin() : LittleBrother{
		return $this->plugin;
	}
}