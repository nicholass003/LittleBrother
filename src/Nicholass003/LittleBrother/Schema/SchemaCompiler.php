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

	public function compile(array $fields) : array{
		$instructions = [];

		foreach($fields as $field){

			$type = $field['type'] ?? null;

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
				$entryInstructions = $this->compile($field['entry'] ?? []);

				$entryPipeline = static function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst
				) use ($entryInstructions) : void{

					foreach($entryInstructions as $op){
						$op($in, $out, $types, $src, $dst);
					}
				};

				$instructions[] = static function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst
				) use ($countType, $entryPipeline) : void{

					$count = $types->read($in, $countType, $src);
					$types->write($out, $countType, $count, $dst);

					for($i = 0; $i < $count; $i++){
						$entryPipeline($in, $out, $types, $src, $dst);
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

					$subInstructions = $this->compile([$value]);

					$subPipeline = static function(
						ByteBufferReader $in,
						ByteBufferWriter $out,
						TypeRegistry $types,
						int $src,
						int $dst
					) use ($subInstructions) : void{

						foreach($subInstructions as $op){
							$op($in, $out, $types, $src, $dst);
						}
					};

					$instructions[] = static function(
						ByteBufferReader $in,
						ByteBufferWriter $out,
						TypeRegistry $types,
						int $src,
						int $dst
					) use ($subPipeline) : void{

						$has = $types->read($in, "bool", $src);
						$types->write($out, "bool", $has, $dst);

						if($has){
							$subPipeline($in, $out, $types, $src, $dst);
						}
					};

					continue;
				}

				/*
				* Primitive Value
				*/
				$valueType = $value;

				$instructions[] = static function(
					ByteBufferReader $in,
					ByteBufferWriter $out,
					TypeRegistry $types,
					int $src,
					int $dst
				) use ($valueType) : void{

					$has = $types->read($in, "bool", $src);
					$types->write($out, "bool", $has, $dst);

					if($has){
						$v = $types->read($in, $valueType, $src);
						$types->write($out, $valueType, $v, $dst);
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
			$instructions[] = $this->compileScalar($field);
		}

		return $instructions;
	}

	private function compileScalar(array $field) : callable{

		$type = $field['type'];
		$since = $field['since'] ?? null;
		$until = $field['until'] ?? null;
		$default = $field['default'] ?? null;

		return static function(
			ByteBufferReader $in,
			ByteBufferWriter $out,
			TypeRegistry $types,
			int $src,
			int $dst
		) use ($type, $since, $until, $default) : void{

			$inSrc = true;
			$inDst = true;

			if($since !== null){
				if($src < $since) $inSrc = false;
				if($dst < $since) $inDst = false;
			}

			if($until !== null){
				if($src > $until) $inSrc = false;
				if($dst > $until) $inDst = false;
			}

			if($inSrc && $inDst){
				$value = $types->read($in, $type, $src);
				$types->write($out, $type, $value, $dst);
			}
			elseif($inSrc){
				$types->read($in, $type, $src);
			}
			elseif($inDst){
				$types->write($out, $type, $default, $dst);
			}
		};
	}
}