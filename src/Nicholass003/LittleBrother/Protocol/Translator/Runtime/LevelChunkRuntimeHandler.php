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

namespace Nicholass003\LittleBrother\Protocol\Translator\Runtime;

use Nicholass003\LittleBrother\Convert\Block\ChunkTranslator;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketHandler;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\ChunkPosition;
use pocketmine\utils\Limits;
use const PHP_INT_MAX;

final class LevelChunkRuntimeHandler implements RuntimePacketHandler{

	private const CLIENT_REQUEST_FULL_COLUMN_FAKE_COUNT = Limits::UINT32_MAX;
	private const CLIENT_REQUEST_TRUNCATED_COLUMN_FAKE_COUNT = Limits::UINT32_MAX - 1;

	public function __construct(
		private ChunkTranslator $chunkTranslator
	){}

	public function translateOutbound(int $protocol, string $payload) : string{
		$reader = new ByteBufferReader($payload);
		$writer = new ByteBufferWriter();

		// ChunkPosition
		$chunkPos = ChunkPosition::read($reader);
		$chunkPos->write($writer);

		// Dimension
		$dimension = VarInt::readSignedInt($reader);
		VarInt::writeSignedInt($writer, $dimension);

		// subChunkCount
		$rawCount = VarInt::readUnsignedInt($reader);

		if($rawCount === self::CLIENT_REQUEST_FULL_COLUMN_FAKE_COUNT){
			VarInt::writeUnsignedInt($writer, $rawCount);
			$subChunkCount = PHP_INT_MAX;
			$clientSubChunkMode = true;
		}elseif($rawCount === self::CLIENT_REQUEST_TRUNCATED_COLUMN_FAKE_COUNT){
			VarInt::writeUnsignedInt($writer, $rawCount);
			$truncated = LE::readUnsignedShort($reader);
			LE::writeUnsignedShort($writer, $truncated);
			$subChunkCount = $truncated;
			$clientSubChunkMode = true;
		}else{
			VarInt::writeUnsignedInt($writer, $rawCount);
			$subChunkCount = $rawCount;
			$clientSubChunkMode = false;
		}

		$cacheEnabled = CommonTypes::getBool($reader);
		CommonTypes::putBool($writer, $cacheEnabled);

		if($cacheEnabled){
			$hashCount = VarInt::readUnsignedInt($reader);
			VarInt::writeUnsignedInt($writer, $hashCount);
			for($i = 0; $i < $hashCount; $i++){
				LE::writeUnsignedLong($writer, LE::readUnsignedLong($reader));
			}
		}

		// extraPayload
		$payloadLength = VarInt::readUnsignedInt($reader);
		if($payloadLength > $reader->getUnreadLength()){
			return $payload;
		}

		$chunkData = $reader->readByteArray($payloadLength);

		$translated = $this->chunkTranslator->translateChunkOutbound(
			$protocol,
			$chunkData,
			$subChunkCount
		);

		CommonTypes::putString($writer, $translated);

		return $writer->getData();
	}

	public function translateInbound(int $protocol, string $payload) : string{
		return $payload;
	}
}