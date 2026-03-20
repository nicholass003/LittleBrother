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

use Nicholass003\LittleBrother\Schema\PacketContext;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

final class TypeRegistry{

	/** @var array<string, array{reader: callable, writer: callable}> */
	private array $types = [];

	/**
	 * Register type.
	 *
	 * @param callable(ByteBufferReader $in, int $protocol, ProtocolContext $context): mixed               $reader
	 * @param callable(ByteBufferWriter $out, mixed $value, int $protocol, ProtocolContext $context): void $writer
	 */
	public function register(string $type, callable $reader, callable $writer) : void{
		$this->types[$type] = ['reader' => $reader, 'writer' => $writer];
	}

	/**
	 * @return mixed
	 * @throws \RuntimeException
	 */
	public function read(ByteBufferReader $in, string $type, int $protocol, PacketContext $context) : mixed{
		if(!isset($this->types[$type])){
			throw new \RuntimeException("Unknown type: '$type' (protocol=$protocol)");
		}
		return ($this->types[$type]['reader'])($in, $protocol, $context);
	}

	/**
	 * @param mixed $value
	 * @throws \RuntimeException
	 */
	public function write(ByteBufferWriter $out, string $type, mixed $value, int $protocol, PacketContext $context) : void{
		if(!isset($this->types[$type])){
			throw new \RuntimeException("Unknown type: '$type' (protocol=$protocol)");
		}
		($this->types[$type]['writer'])($out, $value, $protocol, $context);
	}

	public function has(string $type) : bool{
		return isset($this->types[$type]);
	}
}