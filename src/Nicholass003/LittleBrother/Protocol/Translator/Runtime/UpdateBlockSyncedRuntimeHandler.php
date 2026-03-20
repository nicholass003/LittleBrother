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

use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateBlockSyncedRuntimeHandler extends UpdateBlockRuntimeHandler{

	public function translateOutbound(int $protocol, string $payload) : string{
		$payload = parent::translateOutbound($protocol, $payload);
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();

		VarInt::writeUnsignedLong($out, VarInt::readUnsignedLong($in));
		VarInt::writeUnsignedLong($out, VarInt::readUnsignedLong($in));
		return $payload;
	}

	public function translateInbound(int $protocol, string $payload) : string{
		$payload = parent::translateInbound($protocol, $payload);
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();

		VarInt::writeUnsignedLong($out, VarInt::readUnsignedLong($in));
		VarInt::writeUnsignedLong($out, VarInt::readUnsignedLong($in));
		return $payload;
	}
}