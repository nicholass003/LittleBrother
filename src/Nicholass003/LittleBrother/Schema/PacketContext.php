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

use Nicholass003\LittleBrother\Types\TypeRegistry;

final class PacketContext{

	public function __construct(
		private readonly TypeRegistry $registry
	){}

	private array $storage = [];

	public function set(string $key, mixed $value) : void{
		$this->storage[$key] = $value;
	}

	public function get(string $key) : mixed{
		return $this->storage[$key] ?? null;
	}

	public function clear() : void{
		$this->storage = [];
	}

	public function getTypeRegistry() : TypeRegistry{
		return $this->registry;
	}
}