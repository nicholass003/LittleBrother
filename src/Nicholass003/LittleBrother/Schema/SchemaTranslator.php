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

namespace Nicholass003\LittleBrother\Schema;

use Nicholass003\LittleBrother\Types\TypeRegistryFactory;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

final class SchemaTranslator{

	public function __construct(
		private TypeRegistryFactory $typesFactory,
		private SchemaRegistry $schemas
	){}

	public function translateInbound(int $protocol, int $packetId, ByteBufferReader $reader) : string|null|false{
		$schema = $this->schemas->getInbound($packetId);

		if($schema === null){
			return $reader->getUnreadLength() > 0
				? $reader->readByteArray($reader->getUnreadLength())
				: '';
		}

		if($schema->manual){
			return false;
		}

		if($schema->since !== null && $protocol < $schema->since){
			return null;
		}

		$types = $this->typesFactory->createForInbound($protocol);

		$writer = new ByteBufferWriter();

		$src = $protocol;
		$dst = ProtocolInfo::CURRENT_PROTOCOL;
		$context = new PacketContext();

		foreach($schema->instructions as $op){
			$op($reader, $writer, $types, $src, $dst, $context);
		}

		return $writer->getData();
	}

	public function translateOutbound(int $protocol, int $packetId, ByteBufferReader $reader) : string|null|false{
		$schema = $this->schemas->getOutbound($packetId);

		if($schema === null){
			Debugger::debug("SCHEMA NOT FOUND FOR PACKET ID : " . $packetId, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
			return $reader->getUnreadLength() > 0
				? $reader->readByteArray($reader->getUnreadLength())
				: '';
		}

		if($schema->manual){
			Debugger::debug("PACKET NAME : " . $schema->packet, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET || $packetId === ProtocolInfo::LEVEL_CHUNK_PACKET);
			return false;
		}

		if($schema->since !== null && $protocol < $schema->since){
			return null;
		}

		$types = $this->typesFactory->createForOutbound($protocol);

		$writer = new ByteBufferWriter();

		$src = ProtocolInfo::CURRENT_PROTOCOL;
		$dst = $protocol;
		$context = new PacketContext();

		foreach($schema->instructions as $op){
			$op($reader, $writer, $types, $src, $dst, $context);
		}

		return $writer->getData();
	}

	public function getSchemaRegistry() : SchemaRegistry{
		return $this->schemas;
	}
}