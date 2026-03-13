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
use Nicholass003\LittleBrother\Protocol\Translator\Handler\CraftingDataPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\ItemStackResponsePacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\MovePlayerPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\PlayerAuthInputPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\PlayerListPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\StartGamePacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Handler\TextPacketHandler;
use Nicholass003\LittleBrother\Protocol\Translator\Runtime\LevelChunkRuntimeHandler;
use Nicholass003\LittleBrother\Schema\SchemaTranslator;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

final class PacketTranslator{

	private ByteBufferWriter $writer;

	public function __construct(
		private SchemaTranslator $schema,
		private ManualPacketRegistry $manual,
		private RuntimePacketRegistry $runtime,
		private LittleBrother $plugin
	){
		$this->writer = new ByteBufferWriter();
		$this->registerRuntimePacketHandlers();
		$this->registerHandlers();
	}

	private function registerRuntimePacketHandlers() : void{
		$runtime = $this->runtime;
		$runtime->register(
			ProtocolInfo::LEVEL_CHUNK_PACKET,
			new LevelChunkRuntimeHandler($this->plugin->getChunkTranslator())
		);
	}

	private function registerHandlers() : void{
		$registry = $this->manual;
		$registry->register(ProtocolInfo::CRAFTING_DATA_PACKET, new CraftingDataPacketHandler());
		$registry->register(ProtocolInfo::PLAYER_LIST_PACKET, new PlayerListPacketHandler());
		$registry->register(ProtocolInfo::START_GAME_PACKET, new StartGamePacketHandler());
		$registry->register(ProtocolInfo::TEXT_PACKET, new TextPacketHandler());
		$registry->register(ProtocolInfo::PLAYER_AUTH_INPUT_PACKET, new PlayerAuthInputPacketHandler());
		$registry->register(ProtocolInfo::MOVE_PLAYER_PACKET, new MovePlayerPacketHandler());
		$registry->register(ProtocolInfo::ITEM_STACK_RESPONSE_PACKET, new ItemStackResponsePacketHandler());
	}

	public function translateInbound(int $protocol, string $payload) : ?string{

		$reader = new ByteBufferReader($payload);

		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;

		$result = $this->schema->translateInbound(
			$protocol,
			$packetId,
			$reader
		);
		$runtime = $this->runtime->get($packetId);

		if($runtime !== null){
			$result = $runtime->translateInbound($protocol, $result);
		}

		if($result === null){
			return null;
		}

		if($result === false){

			Debugger::debug("Packet ID: " . $packetId, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
			$handler = $this->manual->get($packetId);

			$fields = $reader->getUnreadLength() > 0
				? $reader->readByteArray($reader->getUnreadLength())
				: "";

			if($handler !== null){

				$fieldReader = new ByteBufferReader($fields);

				$fields = $handler->translateInbound(
					$protocol,
					$fieldReader
				);
			}

			$this->writer->clear();

			VarInt::writeUnsignedInt($this->writer, $header);

			if($fields !== ""){
				$this->writer->writeByteArray($fields);
			}

			return $this->writer->getData();
		}

		$this->writer->clear();

		VarInt::writeUnsignedInt($this->writer, $header);

		if($result !== ""){
			$this->writer->writeByteArray($result);
		}

		return $this->writer->getData();
	}

	public function translateOutbound(int $protocol, string $payload) : ?string{
		$reader = new ByteBufferReader($payload);

		$header = VarInt::readUnsignedInt($reader);
		$packetId = $header & DataPacket::PID_MASK;
		Debugger::debug("TRYING TO TRANSLATE", $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);

		$result = $this->schema->translateOutbound(
			$protocol,
			$packetId,
			$reader
		);
		$runtime = $this->runtime->get($packetId);

		if($runtime !== null){
			Debugger::debug("RUNTIME PACKET HANDLER", $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
			$result = $runtime->translateOutbound($protocol, $result);
		}

		if($result === null){
			Debugger::debug("Result NULL on Packet ID: " . $packetId, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
			return null;
		}

		if($result === false){

			Debugger::debug("Packet ID: " . $packetId, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
			$handler = $this->manual->get($packetId);

			$fields = $reader->getUnreadLength() > 0
				? $reader->readByteArray($reader->getUnreadLength())
				: "";

			if($handler !== null){

				$fieldReader = new ByteBufferReader($fields);

				$fields = $handler->translateOutbound(
					$protocol,
					$fieldReader
				);
			}

			$this->writer->clear();

			VarInt::writeUnsignedInt($this->writer, $header);

			if($fields !== ""){
				$this->writer->writeByteArray($fields);
			}

			return $this->writer->getData();
		}

		$this->writer->clear();

		VarInt::writeUnsignedInt($this->writer, $header);

		if($result !== ""){
			$this->writer->writeByteArray($result);
		}

		return $this->writer->getData();
	}

	public function getManualRegistry() : ManualPacketRegistry{
		return $this->manual;
	}
}