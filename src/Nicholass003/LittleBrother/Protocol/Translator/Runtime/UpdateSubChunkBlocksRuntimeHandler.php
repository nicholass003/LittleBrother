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

use Nicholass003\LittleBrother\Convert\Block\RuntimeBlockMapper;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketHandler;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

final class UpdateSubChunkBlocksRuntimeHandler implements RuntimePacketHandler{

	public function __construct(
		private RuntimeBlockMapper $mapper
	){}

	public function translateOutbound(int $protocol, string $payload) : string{
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();

		if($protocol >= ProtocolVersion::BE_1_26_10){
			$pos = CommonTypes::getSignedBlockPosition($in);
			CommonTypes::putBlockPosition($out, $pos);
		}else{
			$pos = CommonTypes::getBlockPosition($in);
			CommonTypes::putBlockPosition($out, $pos);
		}

		$layer = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $layer);

		$count = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $count);

		for($i = 0; $i < $count; $i++){
			$index = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $index);

			$runtimeId = VarInt::readUnsignedInt($in);
			$runtimeId = $this->mapper->serverToClient($protocol, $runtimeId);
			VarInt::writeUnsignedInt($out, $runtimeId);

			$flags = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $flags);
		}

		return $out->getData();
	}

	public function translateInbound(int $protocol, string $payload) : string{
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();

		if($protocol >= ProtocolVersion::BE_1_26_10){
			$pos = CommonTypes::getSignedBlockPosition($in);
			CommonTypes::putBlockPosition($out, $pos);
		}else{
			$pos = CommonTypes::getBlockPosition($in);
			CommonTypes::putBlockPosition($out, $pos);
		}

		VarInt::writeUnsignedInt($out, VarInt::readUnsignedInt($in));

		$count = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $count);

		for($i = 0; $i < $count; $i++){

			$index = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $index);

			$runtimeId = VarInt::readUnsignedInt($in);
			$runtimeId = $this->mapper->clientToServer($protocol, $runtimeId);
			VarInt::writeUnsignedInt($out, $runtimeId);

			VarInt::writeUnsignedInt($out, VarInt::readUnsignedInt($in));
		}

		return $out->getData();
	}
}