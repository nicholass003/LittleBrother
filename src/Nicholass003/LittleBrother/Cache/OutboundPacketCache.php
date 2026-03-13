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

namespace Nicholass003\LittleBrother\Cache;

use function array_shift;
use function count;
use function hash;
use function strlen;

final class OutboundPacketCache{

	private const MAX_ENTRIES = 2048;

	private array $order = [];

	/** @var array<string, string> key → translated payload */
	private array $cache = [];

	public function get(int $protocol, string $payload) : ?string{
		return $this->cache[$this->buildKey($protocol, $payload)] ?? null;
	}

	public function set(int $protocol, string $payload, string $translated) : void{
		if(count($this->cache) >= self::MAX_ENTRIES){
			$old = array_shift($this->order);
			unset($this->cache[$old]);
		}
		$key = $this->buildKey($protocol, $payload);
		$this->cache[$key] = $translated;
		$this->order[] = $key;
	}

	public function clear() : void{
		$this->cache = [];
	}

	/**
	 * Key: "protocol:length:xxh32hash"
	 */
	private function buildKey(int $protocol, string $payload) : string{
		return $protocol . ':' . strlen($payload) . ':' . hash('xxh32', $payload);
	}
}