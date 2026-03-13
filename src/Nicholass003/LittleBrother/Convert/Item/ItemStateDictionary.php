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

namespace Nicholass003\LittleBrother\Convert\Item;

use pocketmine\utils\Filesystem;
use RuntimeException;
use function count;
use function is_array;
use function json_decode;

final class ItemStateDictionary{

	/** @var string[] index = runtimeId, value = stringId */
	private array $runtimeIdToString = [];

	/** @var int[] key = stringId, value = runtimeId */
	private array $stringToRuntimeId = [];

	public function __construct(string $path){
		$json = Filesystem::fileGetContents($path);
		if($json === false){
			throw new RuntimeException("Cannot read: $path");
		}

		$data = json_decode($json, true);
		if(!is_array($data)){
			throw new RuntimeException("Invalid JSON in: $path");
		}

		foreach($data as $stringId => $entry){
			$runtimeId = (int) $entry['runtime_id'];
			$this->runtimeIdToString[$runtimeId] = $stringId;
			$this->stringToRuntimeId[$stringId] = $runtimeId;
		}
	}

	public function runtimeIdToString(int $runtimeId) : ?string{
		return $this->runtimeIdToString[$runtimeId] ?? null;
	}

	public function stringToRuntimeId(string $stringId) : ?int{
		return $this->stringToRuntimeId[$stringId] ?? null;
	}

	/**
	 * @return string[]
	 */
	public function getAll() : array{
		return $this->runtimeIdToString;
	}

	public function count() : int{
		return count($this->runtimeIdToString);
	}
}