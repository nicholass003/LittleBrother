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

namespace Nicholass003\LittleBrother\Protocol\Translator\Handler;

use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketHandler;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class AnimatePacketHandler extends ManualPacketHandler{
	public const ACTION_ROW_RIGHT = 128;
	public const ACTION_ROW_LEFT = 129;

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();
		if($protocol >= ProtocolVersion::BE_1_21_130){
			$action = Byte::readUnsigned($in);
			Byte::writeUnsigned($out, $action);
		}else{
			$action = VarInt::readSignedInt($in);
			VarInt::writeSignedInt($out, $action);
		}
		CommonTypes::putActorRuntimeId($out, CommonTypes::getActorRuntimeId($in));
		LE::writeFloat($out, LE::readFloat($in));
		if($protocol <= ProtocolVersion::BE_1_21_120){
			if($action === self::ACTION_ROW_LEFT || $action === self::ACTION_ROW_RIGHT){
				LE::writeFloat($out, LE::readFloat($in));
			}
		}else{
			CommonTypes::writeOptional($out, CommonTypes::readOptional($in, CommonTypes::getString(...)), CommonTypes::putString(...));
		}
		return $out->getData();
	}

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();
		if($protocol >= ProtocolVersion::BE_1_21_130){
			$action = Byte::readUnsigned($in);
			Byte::writeUnsigned($out, $action);
		}else{
			$action = VarInt::readSignedInt($in);
		}
		CommonTypes::putActorRuntimeId($out, CommonTypes::getActorRuntimeId($in));
		LE::writeFloat($out, LE::readFloat($in));
		if($protocol <= ProtocolVersion::BE_1_21_120){
			if($action === self::ACTION_ROW_LEFT || $action === self::ACTION_ROW_RIGHT){
				LE::readFloat($in);
			}
		}else{
			CommonTypes::writeOptional($out, CommonTypes::readOptional($in, CommonTypes::getString(...)), CommonTypes::putString(...));
		}
		return $out->getData();
	}
}