#!/usr/bin/env php
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

use pocketmine\data\bedrock\block\BlockStateData;
use pocketmine\errorhandler\ErrorToExceptionHandler;
use pocketmine\nbt\BigEndianNbtSerializer;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\TreeRoot;
use pocketmine\network\mcpe\protocol\serializer\NetworkNbtSerializer;

require __DIR__ . '/../vendor/autoload.php';

$opts = getopt('', ['config:', 'token:']);

$configPath = $opts['config'] ?? 'config.json';

if(!file_exists($configPath)){
	echo "ERROR: config file not found\n";
	exit(1);
}

$config = json_decode(file_get_contents($configPath), true);

if(!is_array($config)){
	echo "ERROR: invalid config.json\n";
	exit(1);
}

$versions = $config['versions'] ?? [];
$outDir = rtrim($config['out_dir'] ?? "resources/data/bedrock", "/");
$token = $opts['token'] ?? $config['token'] ?? null;

if(empty($versions)){
	echo "ERROR: No versions configured\n";
	exit(1);
}

echo "\n=== LittleBrother Protocol Data Generator ===\n\n";

foreach($versions as $protocol => $dataset){
	$protocol = (int) $protocol;

	if(is_array($dataset)){
		$bedrockBranch = $dataset["bedrock_data"] ?? null;
		$networkVersion = $dataset["network_data"] ?? null;
	}else{
		$bedrockBranch = $dataset;
		$networkVersion = preg_replace('/^bedrock-/', '', $dataset);
	}

	echo "Protocol $protocol\n";

	$dir = "$outDir/$protocol";

	if(!is_dir($dir)){
		mkdir($dir, 0755, true);
	}

	$canonicalPath = "$dir/canonical_block_states.nbt";
	$metaPath = "$dir/block_state_meta_map.json";
	$requiredPath = "$dir/required_item_list.json";

	/*
	 * BEDROCK DATA (direct download)
	 */

	if($bedrockBranch !== null){
		if(!file_exists($canonicalPath)){
			echo "  fetching canonical_block_states\n";
			file_put_contents(
				$canonicalPath,
				githubFetch("https://raw.githubusercontent.com/axolotl-pm/BedrockData/$bedrockBranch/canonical_block_states.nbt", $token)
			);
		}

		if(!file_exists($metaPath)){
			echo "  fetching block_state_meta_map\n";
			file_put_contents(
				$metaPath,
				githubFetch("https://raw.githubusercontent.com/axolotl-pm/BedrockData/$bedrockBranch/block_state_meta_map.json", $token)
			);
		}

		if(!file_exists($requiredPath)){
			echo "  fetching required_item_list\n";
			file_put_contents(
				$requiredPath,
				githubFetch("https://raw.githubusercontent.com/axolotl-pm/BedrockData/$bedrockBranch/required_item_list.json", $token)
			);
		}

	}else{

		/*
		 * NETWORK DATA fallback
		 */

		if($networkVersion !== null){
			if(!file_exists($canonicalPath)){
				echo "  converting block_palette → canonical_block_states\n";

				$paletteData = githubFetch(
					"https://raw.githubusercontent.com/Kaooot/bedrock-network-data/master/release/$networkVersion/block_palette.nbt",
					$token
				);

				$canonicalData = convertPaletteToCanonical($paletteData);

				file_put_contents($canonicalPath, $canonicalData);
			}

			if(!file_exists($metaPath)){
				echo "  generating block_state_meta_map\n";
				file_put_contents(
					$metaPath,
					json_encode(generateMetaMap($canonicalPath), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
				);
			}

			if(!file_exists($requiredPath)){
				echo "  generating required_item_list\n";

				$itemPalette = githubFetch(
					"https://raw.githubusercontent.com/Kaooot/bedrock-network-data/master/release/$networkVersion/item_palette.json",
					$token
				);

				$itemComponentsNbt = githubFetch(
					"https://raw.githubusercontent.com/Kaooot/bedrock-network-data/master/release/$networkVersion/item_components.nbt",
					$token
				);

				file_put_contents(
					$requiredPath,
					json_encode(generateRequiredItemListFromString($itemPalette, $itemComponentsNbt), JSON_PRETTY_PRINT)
				);
			}

		}else{
			echo "  no dataset available\n";
		}
	}

	echo "  done\n\n";
}

echo "Finished\n";
echo "Output: $outDir\n";

function githubFetch(string $url, ?string $token) : string{
	$headers = ["User-Agent: LittleBrother-Generator"];

	if($token){
		$headers[] = "Authorization: Bearer $token";
	}

	$ctx = stream_context_create([
		"http" => [
			"header" => implode("\r\n", $headers),
			"timeout" => 30
		]
	]);

	$data = file_get_contents($url, false, $ctx);

	if($data === false){
		throw new RuntimeException("Failed to fetch $url");
	}

	return $data;
}

/**
 * Ported from Azvyl's block_palette.nbt -> canonical_block_states.nbt converter
 * @see https://gist.github.com/Azvyl/942e8cf8534d3e48ea990aa4503b59f1
 */
function convertPaletteToCanonical(string $paletteData) : string{
	$decompressed = ErrorToExceptionHandler::trapAndRemoveFalse(fn() => zlib_decode($paletteData));

	$compoundTag = (new BigEndianNbtSerializer())->read($decompressed)->mustGetCompoundTag();

	$block_states = [];

	/** @var CompoundTag $block */
	foreach($compoundTag->getListTag("blocks") as $block){
		$block->removeTag("name_hash", "network_id", "block_id");

		$block_states[] = new TreeRoot(
			BlockStateData::fromNbt($block)->toVanillaNbt()
		);
	}

	return (new NetworkNbtSerializer())->writeMultiple($block_states);
}

function generateMetaMap(string $nbtPath) : array {
	$serializer = new NetworkNbtSerializer();
	$trees = $serializer->readMultiple(file_get_contents($nbtPath));

	$meta = [];
	$lastBlockName = null;
	$currentMeta = -1;

	foreach($trees as $tree){
		$tag = $tree->mustGetCompoundTag();
		$blockName = $tag->getString("name");

		if($blockName !== $lastBlockName){
			$currentMeta = 0;
			$lastBlockName = $blockName;
		}else{
			$currentMeta++;
		}

		$meta[] = $currentMeta;
	}

	return $meta;
}

/**
 * @param string $json              String JSON from item_palette.json
 * @param string $itemComponentsNbt Binary NBT data from item_components.nbt
 * @return array
 */
function generateRequiredItemListFromString(string $json, string $itemComponentsNbt) : array{
	$data = json_decode($json, true);

	if(!isset($data["items"])){
		return [];
	}

	$decompressed = ErrorToExceptionHandler::trapAndRemoveFalse(fn() => zlib_decode($itemComponentsNbt));

	$serializer = new BigEndianNbtSerializer();
	$root = $serializer->read($decompressed)->mustGetCompoundTag();
	$emptyNBT = new CompoundTag();
	$componentMap = [];
	foreach($root->getValue() as $itemName => $componentsTag){
		if(!$emptyNBT->equals($componentsTag)){
			/** @var CompoundTag $componentsTag */
			$componentNBT = CompoundTag::create()->setTag("components", $componentsTag->getCompoundTag("components"));
			$componentMap[$itemName] = base64_encode((new LittleEndianNbtSerializer())->write(new TreeRoot($componentNBT)));
		}
	}

	$items = $data["items"];
	usort($items, fn($a, $b) => strcmp($a["name"], $b["name"]));

	$result = [];

	foreach($items as $item){
		$name = $item["name"];
		$hasComponent = $item["component_based"] ?? false;

		$result[$name] = [
			"runtime_id" => $item["id"] ?? 0,
			"component_based" => $hasComponent,
			"version" => $item["version"] ?? 2
		];

		if(isset($componentMap[$name])){
			$result[$name]["component_nbt"] = $componentMap[$name];
		}
	}

	return $result;
}
