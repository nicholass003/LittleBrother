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

namespace Nicholass003\LittleBrother\Convert\Block;

use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\world\format\PalettedBlockArray;
use const PHP_INT_MAX;

final class ChunkTranslator{

	public function __construct(
		private RuntimeBlockMapper $blockMapper
	){}

	public function translateChunkOutbound(int $clientProtocol, string $data, int $subChunkCount) : string{
		if($subChunkCount === 0 || $data === ''){
			return $data;
		}

		$reader = new ByteBufferReader($data);
		$writer = new ByteBufferWriter();

		$translated = 0;

		while($reader->getUnreadLength() > 0){
			if($subChunkCount !== PHP_INT_MAX && $translated >= $subChunkCount){
				break;
			}

			if(!$this->translateSubChunk($reader, $writer, $clientProtocol)){
				Debugger::log("ChunkTranslator: subchunk $translated failed, flushing " . $reader->getUnreadLength() . " bytes raw");
				$writer->writeByteArray($reader->readByteArray($reader->getUnreadLength()));
				return $writer->getData();
			}

			$translated++;
		}

		if($reader->getUnreadLength() > 0){
			$writer->writeByteArray($reader->readByteArray($reader->getUnreadLength()));
		}

		return $writer->getData();
	}

	private function translateSubChunk(ByteBufferReader $reader, ByteBufferWriter $writer, int $clientProtocol) : bool{
		if($reader->getUnreadLength() < 2){
			return false;
		}

		$version = Byte::readUnsigned($reader);
		Byte::writeUnsigned($writer, $version);

		if($version === 9){
			if($reader->getUnreadLength() < 1) return false;
			Byte::writeSigned($writer, Byte::readSigned($reader));
		}

		$storageCount = Byte::readUnsigned($reader);
		Byte::writeUnsigned($writer, $storageCount);

		for($s = 0; $s < $storageCount; $s++){
			if(!$this->translateBlockStorage($reader, $writer, $clientProtocol)){
				return false;
			}
		}

		return true;
	}

	private function translateBlockStorage(ByteBufferReader $reader,  ByteBufferWriter $writer,int $clientProtocol) : bool{
		if($reader->getUnreadLength() < 1) return false;

		$flags = Byte::readUnsigned($reader);
		$bitsPerBlock = $flags >> 1;
		$isRuntime = ($flags & 1) === 1;
		Byte::writeUnsigned($writer, $flags);

		$wordArraySize = PalettedBlockArray::getExpectedWordArraySize($bitsPerBlock);

		if($reader->getUnreadLength() < $wordArraySize){
			Debugger::log("ChunkTranslator: need $wordArraySize bytes for word array, have " . $reader->getUnreadLength());
			return false;
		}

		$writer->writeByteArray($reader->readByteArray($wordArraySize));

		if($bitsPerBlock === 0){
			if($reader->getUnreadLength() < 1) return false;
			$runtimeId = VarInt::readSignedInt($reader);
			$mapped = $isRuntime ? $this->blockMapper->serverToClient($clientProtocol, $runtimeId) : $runtimeId;
			VarInt::writeSignedInt($writer, $mapped);
			return true;
		}

		if($reader->getUnreadLength() < 1) return false;

		$paletteSize = VarInt::readSignedInt($reader);

		if($paletteSize < 0 || $paletteSize > 4096){
			Debugger::log("ChunkTranslator: bad paletteSize $paletteSize");
			return false;
		}

		VarInt::writeSignedInt($writer, $paletteSize);

		for($i = 0; $i < $paletteSize; $i++){
			if($reader->getUnreadLength() < 1) return false;
			$runtimeId = VarInt::readSignedInt($reader);
			$mapped = $isRuntime ? $this->blockMapper->serverToClient($clientProtocol, $runtimeId) : $runtimeId;
			VarInt::writeSignedInt($writer, $mapped);
		}

		return true;
	}
}