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

namespace Nicholass003\LittleBrother\Convert\Block;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\convert\BlockStateDictionary as ConvertBlockStateDictionary;
use pocketmine\utils\Filesystem;
use function count;
use function implode;
use function sort;

final class BlockStateDictionary{

	private array $runtimeIdToHash = [];
	private array $hashToRuntimeId = [];

	public function __construct(string $canonicalPath, string $metaMapContents){
		$canonicalBlockStatesRaw = Filesystem::fileGetContents($canonicalPath);

		foreach(ConvertBlockStateDictionary::loadPaletteFromString($canonicalBlockStatesRaw) as $i => $state){
			$hash = self::hashState($state->toVanillaNbt());
			$this->runtimeIdToHash[$i] = $hash;
			$this->hashToRuntimeId[$hash] = $i;
		}
	}

	private static function hashState(CompoundTag $state) : string{

		$name = $state->getString('name');

		$states = $state->getCompoundTag('states');

		if($states === null){
			return $name;
		}

		$parts = [];

		$keys = [];

		foreach($states as $key => $tag){
			$keys[] = $key;
		}

		sort($keys);

		foreach($keys as $key){

			$tag = $states->getTag($key);

			$parts[] = $key . '=' . $tag->getValue();
		}

		return $name . "|" . implode(",", $parts);
	}

	public function runtimeIdToHash(int $runtimeId) : string{
		return $this->runtimeIdToHash[$runtimeId];
	}

	public function hashToRuntimeId(string $hash) : ?int{
		return $this->hashToRuntimeId[$hash] ?? null;
	}

	public function count() : int{
		return count($this->runtimeIdToHash);
	}

}