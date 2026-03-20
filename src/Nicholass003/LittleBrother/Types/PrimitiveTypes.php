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

namespace Nicholass003\LittleBrother\Types;

use pmmp\encoding\BE;
use pmmp\encoding\Byte;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

final class PrimitiveTypes{

	public static function register(TypeRegistry $registry) : void{
		$registry->register(
			"u8",
			fn($in, $protocol) => Byte::readUnsigned($in),
			fn($out, $v, $protocol) => Byte::writeUnsigned($out, $v)
		);
		$registry->register(
			"i8",
			fn($in, $protocol) => Byte::readSigned($in),
			fn($out, $v, $protocol) => Byte::writeSigned($out, $v)
		);

		$registry->register(
			"varint",
			fn($in, $protocol) => VarInt::readSignedInt($in),
			fn($out, $v, $protocol) => VarInt::writeSignedInt($out, $v)
		);
		$registry->register(
			"uvarint",
			fn($in, $protocol) => VarInt::readUnsignedInt($in),
			fn($out, $v, $protocol) => VarInt::writeUnsignedInt($out, $v)
		);
		$registry->register(
			"varlong",
			fn($in, $protocol) => VarInt::readSignedLong($in),
			fn($out, $v, $protocol) => VarInt::writeSignedLong($out, $v)
		);
		$registry->register(
			"uvarlong",
			fn($in, $protocol) => VarInt::readUnsignedLong($in),
			fn($out, $v, $protocol) => VarInt::writeUnsignedLong($out, $v)
		);

		$registry->register(
			"le:i16",
			fn($in, $protocol) => LE::readSignedShort($in),
			fn($out, $v, $protocol) => LE::writeSignedShort($out, $v)
		);
		$registry->register(
			"le:u16",
			fn($in, $protocol) => LE::readUnsignedShort($in),
			fn($out, $v, $protocol) => LE::writeUnsignedShort($out, $v)
		);
		$registry->register(
			"le:i32",
			fn($in, $protocol) => LE::readSignedInt($in),
			fn($out, $v, $protocol) => LE::writeSignedInt($out, $v)
		);
		$registry->register(
			"le:u32",
			fn($in, $protocol) => LE::readUnsignedInt($in),
			fn($out, $v, $protocol) => LE::writeUnsignedInt($out, $v)
		);
		$registry->register(
			"le:i64",
			fn($in, $protocol) => LE::readSignedLong($in),
			fn($out, $v, $protocol) => LE::writeSignedLong($out, $v)
		);
		$registry->register(
			"le:u64",
			fn($in, $protocol) => LE::readUnsignedLong($in),
			fn($out, $v, $protocol) => LE::writeUnsignedLong($out, $v)
		);

		$registry->register(
			"le:f32",
			fn($in, $protocol) => LE::readFloat($in),
			fn($out, $v, $protocol) => LE::writeFloat($out, $v)
		);
		$registry->register(
			"le:f64",
			fn($in, $protocol) => LE::readDouble($in),
			fn($out, $v, $protocol) => LE::writeDouble($out, $v)
		);

		$registry->register(
			"be:i16",
			fn($in, $protocol) => BE::readSignedShort($in),
			fn($out, $v, $protocol) => BE::writeSignedShort($out, $v)
		);
		$registry->register(
			"be:u16",
			fn($in, $protocol) => BE::readUnsignedShort($in),
			fn($out, $v, $protocol) => BE::writeUnsignedShort($out, $v)
		);
		$registry->register(
			"be:i32",
			fn($in, $protocol) => BE::readSignedInt($in),
			fn($out, $v, $protocol) => BE::writeSignedInt($out, $v)
		);
		$registry->register(
			"be:u32",
			fn($in, $protocol) => BE::readUnsignedInt($in),
			fn($out, $v, $protocol) => BE::writeUnsignedInt($out, $v)
		);
		$registry->register(
			"be:i64",
			fn($in, $protocol) => BE::readSignedLong($in),
			fn($out, $v, $protocol) => BE::writeSignedLong($out, $v)
		);
		$registry->register(
			"be:u64",
			fn($in, $protocol) => BE::readUnsignedLong($in),
			fn($out, $v, $protocol) => BE::writeUnsignedLong($out, $v)
		);

		$registry->register(
			"be:f32",
			fn($in, $protocol) => BE::readFloat($in),
			fn($out, $v, $protocol) => BE::writeFloat($out, $v)
		);
		$registry->register(
			"be:f64",
			fn($in, $protocol) => BE::readDouble($in),
			fn($out, $v, $protocol) => BE::writeDouble($out, $v)
		);
	}
}