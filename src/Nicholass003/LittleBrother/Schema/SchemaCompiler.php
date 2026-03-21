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
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use function is_array;

final class SchemaCompiler{

	/**
	 * Direction constants for protocol selection in readers
	 */
	public const DIRECTION_INBOUND = 'inbound'; // client → server, reader gets client protocol
	public const DIRECTION_OUTBOUND = 'outbound'; // server → client, reader gets client protocol

	/**
	 * Compile schema fields into executable instructions
	 *
	 * @param array       $fields    Schema field definitions
	 * @param string|null $direction One of DIRECTION_* constants, or null for backward compatibility (uses src)
	 * @return array Array of callable instructions
	 */
	public function compile(array $fields, ?string $direction = null) : array{
		$instructions = [];

		foreach($fields as $field){
			$type = $field['type'] ?? null;

			$since = $field['since'] ?? null;
			$until = $field['until'] ?? null;
			$default = $field['default'] ?? null;

			/*
			 * ARRAY
			 */
			if($type === 'array'){
				if(!isset($field['countType'])){
					$instructions[] = static function() : void{
						throw new \RuntimeException("Cannot translate passthrough array");
					};
					continue;
				}

				$countType = $field['countType'];

				$entryInstructions = $this->compile($field['entry'] ?? [], $direction);

				$entryPipeline = function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst,
					PacketContext $context
				) use ($entryInstructions) : void{
					foreach($entryInstructions as $op){
						$op($in, $out, $types, $src, $dst, $context);
					}
				};

				$instructions[] = function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst,
					PacketContext $context
				) use ($countType, $entryInstructions, $entryPipeline, $since, $until, $default, $field, $direction) : void{

					$existsInSrc = true;
					$existsInDst = true;

					if($since !== null){
						if($src < $since) $existsInSrc = false;
						if($dst < $since) $existsInDst = false;
					}

					if($until !== null){
						if($src > $until) $existsInSrc = false;
						if($dst > $until) $existsInDst = false;
					}

					if(!$existsInSrc && !$existsInDst){
						return;
					}

					if($existsInSrc){
						$protocolForReader = self::getProtocolForReader($src, $dst, $direction);
						$count = $types->read($in, $countType, $protocolForReader, $context);

						if(!empty($field['storeCountAs'])){
							$context->set($field['storeCountAs'], $count);
						}

						if($existsInDst){
							$types->write($out, $countType, $count, $dst, $context);

							$collectValues = [];
							$shouldCollect = !empty($field['collect'] ?? []);

							for($i = 0; $i < $count; $i++){
								$entryPipeline($in, $out, $types, $src, $dst, $context);

								if($shouldCollect){
									foreach($field['collect'] as $collectKey){
										$collectValues[] = $context->get($collectKey);
									}
								}
							}

							if($shouldCollect && !empty($field['storeAs'])){
								$context->set($field['storeAs'], $collectValues);
							}
						}else{
							for($i = 0; $i < $count; $i++){
								foreach($entryInstructions as $op){
									$op($in, $out, $types, $src, $dst, $context);
								}
							}
						}
					}else{
						$writeCount = $default ?? 0;
						$types->write($out, $countType, $writeCount, $dst, $context);
					}
				};

				continue;
			}

			/*
			 * OPTIONAL
			 */
			if($type === 'optional'){

				$value = $field['value'];

				if(is_array($value)){

					$subInstructions = $this->compile([$value], $direction);

					$subPipeline = function(
						ByteBufferReader $in,
						ByteBufferWriter $out,
						TypeRegistry $types,
						int $src,
						int $dst,
						PacketContext $context
					) use ($subInstructions) : void{

						foreach($subInstructions as $op){
							$op($in, $out, $types, $src, $dst, $context);
						}
					};

					$instructions[] = function(
						ByteBufferReader $in,
						ByteBufferWriter $out,
						TypeRegistry $types,
						int $src,
						int $dst,
						PacketContext $context
					) use ($subPipeline, $direction) : void{

						$protocolForReader = self::getProtocolForReader($src, $dst, $direction);
						$has = $types->read($in, "bool", $protocolForReader, $context);
						$types->write($out, "bool", $has, $dst, $context);

						if($has){
							$subPipeline($in, $out, $types, $src, $dst, $context);
						}
					};

					continue;
				}

				/*
				* Primitive Value
				*/
				$valueType = $value;

				$instructions[] = function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst,
					PacketContext $context
				) use ($valueType, $direction) : void{

					$protocolForReader = self::getProtocolForReader($src, $dst, $direction);
					$has = $types->read($in, "bool", $protocolForReader, $context);
					$types->write($out, "bool", $has, $dst, $context);

					if($has){
						$v = $types->read($in, $valueType, $protocolForReader, $context);
						$types->write($out, $valueType, $v, $dst, $context);
					}
				};

				continue;
			}

			/*
			 * OBJECT
			 */
			if($type === 'object'){
				$field['type'] = $field['value'];
			}

			/*
			 * SCALAR / PRIMITIVE
			 */
			$instructions[] = $this->compileScalar($field, $direction);
		}

		return $instructions;
	}

	/**
	 * Determine which protocol should be passed to the type reader
	 *
	 * @param int         $src       Source protocol (where data is coming from)
	 * @param int         $dst       Destination protocol (where data is going to)
	 * @param string|null $direction Direction of translation (DIRECTION_INBOUND or DIRECTION_OUTBOUND)
	 * @return int Protocol to use for reading
	 */
	private static function getProtocolForReader(int $src, int $dst, ?string $direction) : int{
		if($direction === null){
			return $src;
		}

		if($direction === self::DIRECTION_OUTBOUND){
			return $dst;
		}

		if($direction === self::DIRECTION_INBOUND){
			return $src;
		}
		return $src;
	}

	/**
	 * Compile scalar field into instruction
	 *
	 * @param array       $field     Field definition
	 * @param string|null $direction Direction of translation
	 * @return callable Instruction
	 */
	private function compileScalar(array $field, ?string $direction = null) : callable{

		$type = $field['type'];
		$name = $field['name'] ?? null;
		$since = $field['since'] ?? null;
		$until = $field['until'] ?? null;
		$default = $field['default'] ?? null;
		$storeAs = $field['storeAs'] ?? $name;

		return static function(
			ByteBufferReader $in,
			ByteBufferWriter $out,
			TypeRegistry $types,
			int $src,
			int $dst,
			PacketContext $context
		) use ($type, $since, $until, $default, $storeAs, $direction) : void{

			$existsInSrc = true;
			$existsInDst = true;

			if($since !== null){
				if($src < $since) $existsInSrc = false;
				if($dst < $since) $existsInDst = false;
			}

			if($until !== null){
				if($src > $until) $existsInSrc = false;
				if($dst > $until) $existsInDst = false;
			}

			if($existsInSrc){
				$protocolForReader = self::getProtocolForReader($src, $dst, $direction);
				$value = $types->read($in, $type, $protocolForReader, $context);
				$context->set($storeAs, $value);

				if($existsInDst){
					$types->write($out, $type, $value, $dst, $context);
				}
			}else{
				if($existsInDst){
					$types->write($out, $type, $default, $dst, $context);
					$context->set($storeAs, $default);
				}
			}
		};
	}
}