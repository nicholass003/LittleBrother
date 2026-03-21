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

use function array_keys;

final class SchemaRegistry{

	/** @var array<int,PacketSchema> */
	private array $schemas = [];

	/** @var array<int,PacketSchema> */
	private array $inboundSchemas = [];

	/** @var array<int,PacketSchema> */
	private array $outboundSchemas = [];

	private SchemaCompiler $compiler;

	public function __construct(
		SchemaCompiler $compiler
	){
		$this->compiler = $compiler;
	}

	/**
	 * Register a packet schema
	 *
	 * @param PacketSchema $schema The schema to register
	 */
	public function register(PacketSchema $schema) : void{
		$this->schemas[$schema->packetId] = $schema;
	}

	/**
	 * Register a packet schema with separate inbound and outbound instructions
	 *
	 * @param int      $packetId   Packet ID
	 * @param string   $packetName Packet name
	 * @param array    $fields     Schema fields
	 * @param int|null $since      Protocol version since when this packet exists
	 * @param bool     $manual     Whether this packet is handled manually
	 */
	public function registerWithDirection(int $packetId, string $packetName, array $fields, ?int $since = null, bool $manual = false) : void{
		$inboundInstructions = $this->compiler->compile($fields, SchemaCompiler::DIRECTION_INBOUND);
		$inboundSchema = new PacketSchema(
			$packetName,
			$packetId,
			$inboundInstructions,
			since: $since,
			manual: $manual,
		);
		$this->inboundSchemas[$packetId] = $inboundSchema;

		$outboundInstructions = $this->compiler->compile($fields, SchemaCompiler::DIRECTION_OUTBOUND);
		$outboundSchema = new PacketSchema(
			$packetName,
			$packetId,
			$outboundInstructions,
			since: $since,
			manual: $manual,
		);
		$this->outboundSchemas[$packetId] = $outboundSchema;

		$this->schemas[$packetId] = $inboundSchema;
	}

	/**
	 * Get schema for a packet
	 *
	 * @param int $packetId Packet ID
	 * @return PacketSchema|null
	 */
	public function get(int $packetId) : ?PacketSchema{
		return $this->schemas[$packetId] ?? null;
	}

	/**
	 * Get inbound schema for a packet (client → server)
	 *
	 * @param int $packetId Packet ID
	 * @return PacketSchema|null
	 */
	public function getInbound(int $packetId) : ?PacketSchema{
		return $this->inboundSchemas[$packetId] ?? $this->schemas[$packetId] ?? null;
	}

	/**
	 * Get outbound schema for a packet (server → client)
	 *
	 * @param int $packetId Packet ID
	 * @return PacketSchema|null
	 */
	public function getOutbound(int $packetId) : ?PacketSchema{
		return $this->outboundSchemas[$packetId] ?? $this->schemas[$packetId] ?? null;
	}

	/**
	 * Load schemas from array
	 *
	 * @param array $schemas        Array of schemas
	 * @param bool  $useDirectional Whether to compile separate inbound/outbound instructions
	 */
	public function loadSchemas(array $schemas, bool $useDirectional = false) : void{
		foreach($schemas as $packetId => $data){
			$fields = $data['fields'];
			$since = $data['since'] ?? null;
			$manual = $data['manual'] ?? false;
			$packetName = $data['packet'];

			if($useDirectional){
				$this->registerWithDirection(
					(int) $packetId,
					$packetName,
					$fields,
					$since,
					$manual
				);
			}else{
				$instructions = $this->compiler->compile($fields);
				$schema = new PacketSchema(
					$packetName,
					(int) $packetId,
					$instructions,
					since: $since,
					manual: $manual,
				);
				$this->register($schema);
			}
		}
	}

	/**
	 * Load schemas with explicit direction
	 *
	 * @param array       $schemas   Array of schemas
	 * @param string|null $direction Direction to compile for (DIRECTION_INBOUND or DIRECTION_OUTBOUND)
	 */
	public function loadSchemasWithDirection(array $schemas, ?string $direction = null) : void{
		foreach($schemas as $packetId => $data){
			$fields = $data['fields'];
			$since = $data['since'] ?? null;
			$manual = $data['manual'] ?? false;
			$packetName = $data['packet'];

			if($direction !== null){
				$instructions = $this->compiler->compile($fields, $direction);
			}else{
				$instructions = $this->compiler->compile($fields);
			}

			$schema = new PacketSchema(
				$packetName,
				(int) $packetId,
				$instructions,
				since: $since,
				manual: $manual,
			);

			if($direction === SchemaCompiler::DIRECTION_INBOUND){
				$this->inboundSchemas[(int) $packetId] = $schema;
			}elseif($direction === SchemaCompiler::DIRECTION_OUTBOUND){
				$this->outboundSchemas[(int) $packetId] = $schema;
			}

			$this->schemas[(int) $packetId] = $schema;
		}
	}

	/**
	 * Check if a packet schema exists
	 *
	 * @param int $packetId Packet ID
	 * @return bool
	 */
	public function has(int $packetId) : bool{
		return isset($this->schemas[$packetId]);
	}

	/**
	 * Check if inbound schema exists
	 *
	 * @param int $packetId Packet ID
	 * @return bool
	 */
	public function hasInbound(int $packetId) : bool{
		return isset($this->inboundSchemas[$packetId]) || isset($this->schemas[$packetId]);
	}

	/**
	 * Check if outbound schema exists
	 *
	 * @param int $packetId Packet ID
	 * @return bool
	 */
	public function hasOutbound(int $packetId) : bool{
		return isset($this->outboundSchemas[$packetId]) || isset($this->schemas[$packetId]);
	}

	/**
	 * Get all registered packet IDs
	 *
	 * @return int[]
	 */
	public function getPacketIds() : array{
		return array_keys($this->schemas);
	}

	/**
	 * Clear all schemas
	 */
	public function clear() : void{
		$this->schemas = [];
		$this->inboundSchemas = [];
		$this->outboundSchemas = [];
	}
}