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

namespace Nicholass003\LittleBrother\Protocol;

final class ProtocolVersion{
	public const SUPPORTED_PROTOCOLS = [
		self::BE_1_26_10,
		self::BE_1_26_0,
		self::BE_1_21_130,
		self::BE_1_21_120,
		self::BE_1_21_110,
	];

	public const MINECRAFT_VERSIONS = [
		self::BE_1_26_10 => 'v1.26.10',
		self::BE_1_26_0 => 'v1.26.0',
		self::BE_1_21_130 => 'v1.21.130',
		self::BE_1_21_120 => 'v1.21.120',
		self::BE_1_21_110 => 'v1.21.110',
	];

	// Protocol version number
	public const BE_1_26_10 = 944;
	public const BE_1_26_0 = 924;
	public const BE_1_21_130 = 898;
	public const BE_1_21_120 = 860;
	public const BE_1_21_110 = 844;
}