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

use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketHandler;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

final class MovePlayerPacketHandler extends ManualPacketHandler{

	private const MODE_TELEPORT = 2;

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		return $this->passthrough($in);
	}

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();

		CommonTypes::putActorRuntimeId($out, CommonTypes::getActorRuntimeId($in));
		CommonTypes::putVector3($out, CommonTypes::getVector3($in));
		LE::writeFloat($out, LE::readFloat($in)); // pitch
		LE::writeFloat($out, LE::readFloat($in)); // yaw
		LE::writeFloat($out, LE::readFloat($in)); // headYaw

		$mode = Byte::readUnsigned($in);
		Byte::writeUnsigned($out, $mode);

		CommonTypes::putBool($out, CommonTypes::getBool($in)); // onGround
		CommonTypes::putActorRuntimeId($out, CommonTypes::getActorRuntimeId($in)); // ridingActorRuntimeId

		if($mode === self::MODE_TELEPORT){
			LE::writeSignedInt($out, LE::readSignedInt($in)); // teleportCause
			LE::writeSignedInt($out, LE::readSignedInt($in)); // teleportItem
		}

		VarInt::writeUnsignedLong($out, VarInt::readUnsignedLong($in)); // tick

		return $out->getData();
	}
}