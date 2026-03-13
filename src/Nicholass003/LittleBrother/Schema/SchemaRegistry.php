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

final class SchemaRegistry{

	/** @var array<int,PacketSchema> */
	private array $schemas = [];

	private SchemaCompiler $compiler;

	public function __construct(
		SchemaCompiler $compiler
	){
		$this->compiler = $compiler;
	}

	public function register(PacketSchema $schema) : void{
		$this->schemas[$schema->packetId] = $schema;
	}

	public function get(int $packetId) : ?PacketSchema{
		return $this->schemas[$packetId] ?? null;
	}

	public function loadSchemas(array $schemas) : void{
		foreach($schemas as $packetId => $data){
			$fields = $data['fields'];
			$instructions = $this->compiler->compile($fields);
			$schema = new PacketSchema(
				$data['packet'],
				(int) $packetId,
				$instructions,
				since:  $data['since'] ?? null,
				manual: $data['manual'] ?? false,
			);
			$this->register($schema);
		}
	}
}