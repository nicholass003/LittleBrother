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

use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use function ceil;
use function intdiv;
use function substr;

final class ChunkTranslator{

	public function __construct(
		private BlockRuntimeIdMapper $blockMapper
	){}

	public function translateChunkOutbound(int $clientProtocol, string $chunkData) : string{
		if($clientProtocol === ProtocolInfo::CURRENT_PROTOCOL){
			return $chunkData;
		}
		return $this->remapSubChunkData($clientProtocol, $chunkData, inbound: false);
	}

	public function translateChunkInbound(int $clientProtocol, string $chunkData) : string{
		if($clientProtocol === ProtocolInfo::CURRENT_PROTOCOL){
			return $chunkData;
		}
		return $this->remapSubChunkData($clientProtocol, $chunkData, inbound: true);
	}

	private function remapSubChunkData(int $clientProtocol, string $data, bool $inbound) : string{
		$reader = new ByteBufferReader($data);
		$writer = new ByteBufferWriter();

		try{
			$version = Byte::readUnsigned($reader);
			Byte::writeUnsigned($writer, $version);

			if($version === 8 || $version === 9){
				$this->remapVersion8($clientProtocol, $reader, $writer, $inbound, $version === 9);
			}else{
				$remaining = $reader->getUnreadLength();
				if($remaining > 0){
					$writer->writeByteArray($reader->readByteArray($remaining));
				}
			}
		}catch(\Throwable){
			return $data;
		}

		return $writer->getData();
	}

	private function remapVersion8(
		int $clientProtocol,
		ByteBufferReader $reader,
		ByteBufferWriter $writer,
		bool $inbound,
		bool $hasSubChunkIndex
	) : void{
		if($hasSubChunkIndex){
			$subChunkIndex = Byte::readSigned($reader);
			Byte::writeSigned($writer, $subChunkIndex);
		}

		$storageCount = Byte::readUnsigned($reader);
		Byte::writeUnsigned($writer, $storageCount);

		for($i = 0; $i < $storageCount; $i++){
			$this->remapBlockStorage($clientProtocol, $reader, $writer, $inbound);
		}
	}

	private function remapBlockStorage(
		int $clientProtocol,
		ByteBufferReader $reader,
		ByteBufferWriter $writer,
		bool $inbound
	) : void{
		$flags = Byte::readUnsigned($reader);
		$bitsPerBlock = $flags >> 1;
		$isRuntime = ($flags & 1) === 1;
		Byte::writeUnsigned($writer, $flags);

		if($bitsPerBlock === 0){
			$paletteSize = VarInt::readUnsignedInt($reader);
			VarInt::writeUnsignedInt($writer, $paletteSize);
			for($i = 0; $i < $paletteSize; $i++){
				$runtimeId = VarInt::readUnsignedInt($reader);
				$remapped = $this->remapBlockId($clientProtocol, $runtimeId, $inbound);
				VarInt::writeUnsignedInt($writer, $remapped);
			}
			return;
		}

		$blocksPerWord = intdiv(32, $bitsPerBlock);
		$wordCount = (int) ceil(4096 / $blocksPerWord);
		$indicesBytes = $wordCount * 4;

		if($indicesBytes > 0){
			$indices = $reader->readByteArray($indicesBytes);
			$writer->writeByteArray($indices);
		}

		$paletteSize = VarInt::readUnsignedInt($reader);
		VarInt::writeUnsignedInt($writer, $paletteSize);

		for($i = 0; $i < $paletteSize; $i++){
			if($isRuntime){
				$runtimeId = VarInt::readUnsignedInt($reader);
				$remapped = $this->remapBlockId($clientProtocol, $runtimeId, $inbound);
				VarInt::writeUnsignedInt($writer, $remapped);
			}else{
				$this->passthroughNbtCompound($reader, $writer);
			}
		}
	}

	private function remapBlockId(int $clientProtocol, int $runtimeId, bool $inbound) : int{
		$translator = $this->blockMapper->get($clientProtocol);
		if($translator === null) return $runtimeId;
		return $inbound
			? $translator->clientToServer($runtimeId)
			: $translator->serverToClient($runtimeId);
	}

	private function passthroughNbtCompound(
		ByteBufferReader &$reader,
		ByteBufferWriter $writer
	) : void{
		$serializer = new \pocketmine\nbt\LittleEndianNbtSerializer();

		$remaining = $reader->getUnreadLength() > 0
			? $reader->readByteArray($reader->getUnreadLength())
			: '';

		$offset = 0;
		$root = $serializer->read($remaining, $offset);

		$writer->writeByteArray($serializer->write($root));

		$unconsumed = substr($remaining, $offset);
		$reader = new ByteBufferReader($unconsumed !== '' ? $unconsumed : '');
	}
}