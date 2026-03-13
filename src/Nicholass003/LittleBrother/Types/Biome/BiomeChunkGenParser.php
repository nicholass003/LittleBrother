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

namespace Nicholass003\LittleBrother\Types\Biome;

use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use function count;
use const PHP_EOL;

final class BiomeChunkGenParser{

	public static function read(ByteBufferReader $in) : ?array{
		return CommonTypes::readOptional($in, function() use ($in){

			$climate = CommonTypes::readOptional($in, fn() => self::readClimate($in));
			$consolidatedFeatures = CommonTypes::readOptional($in, fn() => self::readConsolidatedFeatures($in));
			$mountainParams = CommonTypes::readOptional($in, fn() => self::readMountainParams($in));
			$surfaceMaterialAdjustment = CommonTypes::readOptional($in, fn() => self::readSurfaceMaterialAdjustment($in));
			$surfaceMaterial = CommonTypes::readOptional($in, fn() => self::readSurfaceMaterial($in));

			$defaultOverworldSurface = CommonTypes::getBool($in);
			$swampSurface = CommonTypes::getBool($in);
			$frozenOceanSurface = CommonTypes::getBool($in);
			$theEndSurface = CommonTypes::getBool($in);

			$mesaSurface = CommonTypes::readOptional($in, fn() => self::readMesaSurface($in));
			$cappedSurface = CommonTypes::readOptional($in, fn() => self::readCappedSurface($in));

			$overworldGenRules = CommonTypes::readOptional($in, fn() => self::readOverworldGenRules($in));
			$multinoiseGenRules = CommonTypes::readOptional($in, fn() => self::readMultinoiseGenRules($in));
			$legacyWorldGenRules = CommonTypes::readOptional($in, fn() => self::readLegacyWorldGenRules($in));

			$replacementsData = CommonTypes::readOptional($in, fn() => self::readReplacements($in));
			$villageType = CommonTypes::readOptional($in, fn() => Byte::readUnsigned($in));

			return [
				'climate' => $climate,
				'consolidatedFeatures' => $consolidatedFeatures,
				'mountainParams' => $mountainParams,
				'surfaceMaterialAdjustment' => $surfaceMaterialAdjustment,
				'surfaceMaterial' => $surfaceMaterial,
				'defaultOverworldSurface' => $defaultOverworldSurface,
				'swampSurface' => $swampSurface,
				'frozenOceanSurface' => $frozenOceanSurface,
				'theEndSurface' => $theEndSurface,
				'mesaSurface' => $mesaSurface,
				'cappedSurface' => $cappedSurface,
				'overworldGenRules' => $overworldGenRules,
				'multinoiseGenRules' => $multinoiseGenRules,
				'legacyWorldGenRules' => $legacyWorldGenRules,
				'replacementsData' => $replacementsData,
				'villageType' => $villageType
			];
		});
	}

	public static function write(ByteBufferWriter $out, ?array $v) : void{
		CommonTypes::writeOptional($out,$v,function() use($out,$v){

			CommonTypes::writeOptional($out,$v['climate'],fn($out,$x) => self::writeClimate($out,$x));
			CommonTypes::writeOptional($out,$v['consolidatedFeatures'],fn($out,$x) => self::writeConsolidatedFeatures($out,$x));
			CommonTypes::writeOptional($out,$v['mountainParams'],fn($out,$x) => self::writeMountainParams($out,$x));
			CommonTypes::writeOptional($out,$v['surfaceMaterialAdjustment'],fn($out,$x) => self::writeSurfaceMaterialAdjustment($out,$x));
			CommonTypes::writeOptional($out,$v['surfaceMaterial'],fn($out,$x) => self::writeSurfaceMaterial($out,$x));

			CommonTypes::putBool($out,$v['defaultOverworldSurface']);
			CommonTypes::putBool($out,$v['swampSurface']);
			CommonTypes::putBool($out,$v['frozenOceanSurface']);
			CommonTypes::putBool($out,$v['theEndSurface']);

			CommonTypes::writeOptional($out,$v['mesaSurface'],fn($out,$x) => self::writeMesaSurface($out,$x));
			CommonTypes::writeOptional($out,$v['cappedSurface'],fn($out,$x) => self::writeCappedSurface($out,$x));

			CommonTypes::writeOptional($out,$v['overworldGenRules'],fn($out,$x) => self::writeOverworldGenRules($out,$x));
			CommonTypes::writeOptional($out,$v['multinoiseGenRules'],fn($out,$x) => self::writeMultinoiseGenRules($out,$x));
			CommonTypes::writeOptional($out,$v['legacyWorldGenRules'],fn($out,$x) => self::writeLegacyWorldGenRules($out,$x));

			CommonTypes::writeOptional($out,$v['replacementsData'],fn($out,$x) => self::writeReplacements($out,$x));
			CommonTypes::writeOptional($out,$v['villageType'],fn($out,$x) => Byte::writeUnsigned($out,$x));
		});
	}

	private static function readClimate(ByteBufferReader $in) : array{
		return[
			'temperature' => LE::readFloat($in),
			'downfall' => LE::readFloat($in),
			'snowMin' => LE::readFloat($in),
			'snowMax' => LE::readFloat($in)
		];
	}

	private static function writeClimate(ByteBufferWriter $out,array $v) : void{
		LE::writeFloat($out,$v['temperature']);
		LE::writeFloat($out,$v['downfall']);
		LE::writeFloat($out,$v['snowMin']);
		LE::writeFloat($out,$v['snowMax']);
	}

	private static function readSurfaceMaterial(ByteBufferReader $in) : array{
		Debugger::debug("readSurfaceMaterial offset element=" . $in->getOffset() . PHP_EOL);
		return[
			'topBlock' => LE::readUnsignedInt($in),
			'midBlock' => LE::readUnsignedInt($in),
			'seaFloorBlock' => LE::readUnsignedInt($in),
			'foundationBlock' => LE::readUnsignedInt($in),
			'seaBlock' => LE::readUnsignedInt($in),
			'seaFloorDepth' => LE::readSignedInt($in)
		];
	}

	private static function writeSurfaceMaterial(ByteBufferWriter $out,array $v) : void{
		LE::writeUnsignedInt($out,$v['topBlock']);
		LE::writeUnsignedInt($out,$v['midBlock']);
		LE::writeUnsignedInt($out,$v['seaFloorBlock']);
		LE::writeUnsignedInt($out,$v['foundationBlock']);
		LE::writeUnsignedInt($out,$v['seaBlock']);
		LE::writeSignedInt($out,$v['seaFloorDepth']);
	}

	private static function readMountainParams(ByteBufferReader $in) : array{
		return[
			'steepBlock' => LE::readUnsignedInt($in),
			'northSlopes' => CommonTypes::getBool($in),
			'southSlopes' => CommonTypes::getBool($in),
			'westSlopes' => CommonTypes::getBool($in),
			'eastSlopes' => CommonTypes::getBool($in),
			'topSlideEnabled' => CommonTypes::getBool($in)
		];
	}

	private static function writeMountainParams(ByteBufferWriter $out,array $v) : void{
		LE::writeUnsignedInt($out,$v['steepBlock']);
		CommonTypes::putBool($out,$v['northSlopes']);
		CommonTypes::putBool($out,$v['southSlopes']);
		CommonTypes::putBool($out,$v['westSlopes']);
		CommonTypes::putBool($out,$v['eastSlopes']);
		CommonTypes::putBool($out,$v['topSlideEnabled']);
	}

	private static function readMultinoiseGenRules(ByteBufferReader $in) : array{
		return[
			'temperature' => LE::readFloat($in),
			'humidity' => LE::readFloat($in),
			'altitude' => LE::readFloat($in),
			'weirdness' => LE::readFloat($in),
			'weight' => LE::readFloat($in)
		];
	}

	private static function writeMultinoiseGenRules(ByteBufferWriter $out,array $v) : void{
		LE::writeFloat($out,$v['temperature']);
		LE::writeFloat($out,$v['humidity']);
		LE::writeFloat($out,$v['altitude']);
		LE::writeFloat($out,$v['weirdness']);
		LE::writeFloat($out,$v['weight']);
	}

	private static function readReplacements(ByteBufferReader $in) : array{
		$count = VarInt::readUnsignedInt($in);
		$list = [];
		for($i = 0;$i < $count;$i++){
			$list[] = self::readReplacement($in);
		}
		return$list;
	}

	private static function writeReplacements(ByteBufferWriter $out,array $list) : void{
		VarInt::writeUnsignedInt($out,count($list));
		foreach($list as $r){
			self::writeReplacement($out,$r);
		}
	}

	private static function readReplacement(ByteBufferReader $in) : array{
		$biome = LE::readSignedShort($in);
		$dimension = VarInt::readSignedInt($in);

		$targets = [];
		$count = VarInt::readUnsignedInt($in);
		for($i = 0;$i < $count;$i++){
			$targets[] = LE::readSignedShort($in);
		}

		return[
			'biome' => $biome,
			'dimension' => $dimension,
			'targets' => $targets,
			'amount' => LE::readFloat($in),
			'replacementIndex' => LE::readUnsignedInt($in)
		];
	}

	private static function writeReplacement(ByteBufferWriter $out,array $v) : void{
		LE::writeSignedShort($out,$v['biome']);
		VarInt::writeSignedInt($out,$v['dimension']);

		VarInt::writeUnsignedInt($out,count($v['targets']));
		foreach($v['targets'] as $b){
			LE::writeSignedShort($out,$b);
		}

		LE::writeFloat($out,$v['amount']);
		LE::writeUnsignedInt($out,$v['replacementIndex']);
	}

	private static function readConsolidatedFeatures(ByteBufferReader $in) : array{
		$count = VarInt::readUnsignedInt($in);
		$features = [];

		for($i = 0; $i < $count; $i++){
			$features[] = self::readConsolidatedFeature($in);
		}

		return $features;
	}

	private static function writeConsolidatedFeatures(ByteBufferWriter $out, array $features) : void{
		VarInt::writeUnsignedInt($out, count($features));

		foreach($features as $feature){
			self::writeConsolidatedFeature($out, $feature);
		}
	}

	private static function readConsolidatedFeature(ByteBufferReader $in) : array{
		Debugger::debug("readConsolidatedFeature offset element=" . $in->getOffset() . PHP_EOL);
		return [
			'scatter' => self::readScatterParam($in),
			'feature' => LE::readSignedShort($in),
			'identifier' => LE::readSignedShort($in),
			'pass' => LE::readSignedShort($in),
			'useInternal' => CommonTypes::getBool($in)
		];
	}

	private static function writeConsolidatedFeature(ByteBufferWriter $out, array $v) : void{
		self::writeScatterParam($out, $v['scatter']);

		LE::writeSignedShort($out, $v['feature']);
		LE::writeSignedShort($out, $v['identifier']);
		LE::writeSignedShort($out, $v['pass']);

		CommonTypes::putBool($out, $v['useInternal']);
	}
	private static function readScatterParam(ByteBufferReader $in) : array{
		Debugger::debug("readScatterParam offset element=" . $in->getOffset() . PHP_EOL);

		$coords = [];
		$count = VarInt::readUnsignedInt($in);

		for($i = 0; $i < $count; $i++){
			$coords[] = self::readCoordinate($in);
		}

		$evalOrder = VarInt::readSignedInt($in);
		$chancePercentType = VarInt::readSignedInt($in);
		$chancePercent = LE::readSignedShort($in);
		$chanceNumerator = LE::readSignedInt($in);
		$chanceDenominator = LE::readSignedInt($in);
		$iterationsType = VarInt::readSignedInt($in);
		$iterations = LE::readSignedShort($in);

		return [
			'coordinates' => $coords,
			'evalOrder' => $evalOrder,
			'chancePercentType' => $chancePercentType,
			'chancePercent' => $chancePercent,
			'chanceNumerator' => $chanceNumerator,
			'chanceDenominator' => $chanceDenominator,
			'iterationsType' => $iterationsType,
			'iterations' => $iterations
		];
	}

	private static function writeScatterParam(ByteBufferWriter $out, array $v) : void{

		VarInt::writeUnsignedInt($out, count($v['coordinates']));

		foreach($v['coordinates'] as $c){
			self::writeCoordinate($out, $c);
		}

		VarInt::writeSignedInt($out, $v['evalOrder']);
		VarInt::writeSignedInt($out, $v['chancePercentType']);
		LE::writeSignedShort($out, $v['chancePercent']);
		LE::writeSignedInt($out, $v['chanceNumerator']);
		LE::writeSignedInt($out, $v['chanceDenominator']);
		VarInt::writeSignedInt($out, $v['iterationsType']);
		LE::writeSignedShort($out, $v['iterations']);
	}
	private static function readCoordinate(ByteBufferReader $in) : array{Debugger::debug("offset=" . $in->getOffset() . PHP_EOL);

		$minValueType = VarInt::readSignedInt($in);
		$minValue = LE::readSignedShort($in);

		$maxValueType = VarInt::readSignedInt($in);
		$maxValue = LE::readSignedShort($in);

		$gridOffset = LE::readUnsignedInt($in);
		$gridStepSize = LE::readUnsignedInt($in);

		$distribution = VarInt::readSignedInt($in);

		return [
			'minValueType' => $minValueType,
			'minValue' => $minValue,
			'maxValueType' => $maxValueType,
			'maxValue' => $maxValue,
			'gridOffset' => $gridOffset,
			'gridStepSize' => $gridStepSize,
			'distribution' => $distribution
		];
	}

	private static function writeCoordinate(ByteBufferWriter $out, array $v) : void{

		VarInt::writeSignedInt($out, $v['minValueType']);
		LE::writeSignedShort($out, $v['minValue']);

		VarInt::writeSignedInt($out, $v['maxValueType']);
		LE::writeSignedShort($out, $v['maxValue']);

		LE::writeUnsignedInt($out, $v['gridOffset']);
		LE::writeUnsignedInt($out, $v['gridStepSize']);

		VarInt::writeSignedInt($out, $v['distribution']);
	}
	private static function readMesaSurface(ByteBufferReader $in) : array{
		return [
			'clayMaterial' => LE::readUnsignedInt($in),
			'hardClayMaterial' => LE::readUnsignedInt($in),
			'brycePillars' => CommonTypes::getBool($in),
			'forest' => CommonTypes::getBool($in)
		];
	}

	private static function writeMesaSurface(ByteBufferWriter $out, array $v) : void{

		LE::writeUnsignedInt($out, $v['clayMaterial']);
		LE::writeUnsignedInt($out, $v['hardClayMaterial']);

		CommonTypes::putBool($out, $v['brycePillars']);
		CommonTypes::putBool($out, $v['forest']);
	}
	private static function readCappedSurface(ByteBufferReader $in) : array{

		$floor = [];
		$count = VarInt::readUnsignedInt($in);

		for($i = 0;$i < $count;$i++){
			$floor[] = LE::readUnsignedInt($in);
		}

		$ceil = [];
		$count = VarInt::readUnsignedInt($in);

		for($i = 0;$i < $count;$i++){
			$ceil[] = LE::readUnsignedInt($in);
		}

		$seaBlock = CommonTypes::readOptional($in, fn() => LE::readUnsignedInt($in));
		$foundationBlock = CommonTypes::readOptional($in, fn() => LE::readUnsignedInt($in));
		$beachBlock = CommonTypes::readOptional($in, fn() => LE::readUnsignedInt($in));

		return[
			'floorBlocks' => $floor,
			'ceilingBlocks' => $ceil,
			'seaBlock' => $seaBlock,
			'foundationBlock' => $foundationBlock,
			'beachBlock' => $beachBlock
		];
	}

	private static function writeCappedSurface(ByteBufferWriter $out, array $v) : void{

		VarInt::writeUnsignedInt($out,count($v['floorBlocks']));
		foreach($v['floorBlocks'] as $b){
			LE::writeUnsignedInt($out,$b);
		}

		VarInt::writeUnsignedInt($out,count($v['ceilingBlocks']));
		foreach($v['ceilingBlocks'] as $b){
			LE::writeUnsignedInt($out,$b);
		}

		CommonTypes::writeOptional($out,$v['seaBlock'],fn($out,$x) => LE::writeUnsignedInt($out,$x));
		CommonTypes::writeOptional($out,$v['foundationBlock'],fn($out,$x) => LE::writeUnsignedInt($out,$x));
		CommonTypes::writeOptional($out,$v['beachBlock'],fn($out,$x) => LE::writeUnsignedInt($out,$x));
	}
	private static function readSurfaceMaterialAdjustment(ByteBufferReader $in) : array{
		Debugger::debug("readSurfaceMaterialAdjustment offset element=" . $in->getOffset() . PHP_EOL);

		$count = VarInt::readUnsignedInt($in);
		$list = [];

		for($i = 0; $i < $count; $i++){
			$list[] = self::readBiomeElement($in);
		}

		return $list;
	}

	private static function writeSurfaceMaterialAdjustment(ByteBufferWriter $out, array $list) : void{

		VarInt::writeUnsignedInt($out, count($list));

		foreach($list as $element){
			self::writeBiomeElement($out, $element);
		}
	}
	private static function readBiomeElement(ByteBufferReader $in) : array{
		Debugger::debug("readBiomeElement offset element=" . $in->getOffset() . PHP_EOL);

		return [
			'noiseFrequencyScale' => LE::readFloat($in),
			'noiseLowerBound' => LE::readFloat($in),
			'noiseUpperBound' => LE::readFloat($in),

			'heightMinType' => VarInt::readSignedInt($in),
			'heightMin' => LE::readSignedShort($in),

			'heightMaxType' => VarInt::readSignedInt($in),
			'heightMax' => LE::readSignedShort($in),

			'surfaceMaterial' => self::readSurfaceMaterial($in)
		];
	}

	private static function writeBiomeElement(ByteBufferWriter $out, array $v) : void{

		LE::writeFloat($out, $v['noiseFrequencyScale']);
		LE::writeFloat($out, $v['noiseLowerBound']);
		LE::writeFloat($out, $v['noiseUpperBound']);

		VarInt::writeSignedInt($out, $v['heightMinType']);
		LE::writeSignedShort($out, $v['heightMin']);

		VarInt::writeSignedInt($out, $v['heightMaxType']);
		LE::writeSignedShort($out, $v['heightMax']);

		self::writeSurfaceMaterial($out, $v['surfaceMaterial']);
	}
	private static function readOverworldGenRules(ByteBufferReader $in) : array{

		return [
			'hillTransformations' => self::readWeightedBiomeArray($in),
			'mutateTransformations' => self::readWeightedBiomeArray($in),
			'riverTransformations' => self::readWeightedBiomeArray($in),
			'shoreTransformations' => self::readWeightedBiomeArray($in),

			'preHillsEdges' => self::readConditionalTransformationArray($in),
			'postShoreEdges' => self::readConditionalTransformationArray($in),

			'climates' => self::readWeightedTemperatureArray($in)
		];
	}

	private static function writeOverworldGenRules(ByteBufferWriter $out, array $v) : void{

		self::writeWeightedBiomeArray($out, $v['hillTransformations']);
		self::writeWeightedBiomeArray($out, $v['mutateTransformations']);
		self::writeWeightedBiomeArray($out, $v['riverTransformations']);
		self::writeWeightedBiomeArray($out, $v['shoreTransformations']);

		self::writeConditionalTransformationArray($out, $v['preHillsEdges']);
		self::writeConditionalTransformationArray($out, $v['postShoreEdges']);

		self::writeWeightedTemperatureArray($out, $v['climates']);
	}
	private static function readWeightedBiomeArray(ByteBufferReader $in) : array{

		$count = VarInt::readUnsignedInt($in);
		$list = [];

		for($i = 0; $i < $count; $i++){
			$list[] = [
				'biome' => LE::readSignedShort($in),
				'weight' => LE::readUnsignedInt($in)
			];
		}

		return $list;
	}

	private static function writeWeightedBiomeArray(ByteBufferWriter $out, array $list) : void{

		VarInt::writeUnsignedInt($out, count($list));

		foreach($list as $v){
			LE::writeSignedShort($out, $v['biome']);
			LE::writeUnsignedInt($out, $v['weight']);
		}
	}
	private static function readConditionalTransformationArray(ByteBufferReader $in) : array{

		$count = VarInt::readUnsignedInt($in);
		$list = [];

		for($i = 0; $i < $count; $i++){

			$weighted = self::readWeightedBiomeArray($in);

			$conditionJSON = LE::readSignedShort($in);
			$minNeighbors = LE::readUnsignedInt($in);

			$list[] = [
				'weightedBiomes' => $weighted,
				'conditionJSON' => $conditionJSON,
				'minPassingNeighbors' => $minNeighbors
			];
		}

		return $list;
	}

	private static function writeConditionalTransformationArray(ByteBufferWriter $out, array $list) : void{

		VarInt::writeUnsignedInt($out, count($list));

		foreach($list as $v){

			self::writeWeightedBiomeArray($out, $v['weightedBiomes']);

			LE::writeSignedShort($out, $v['conditionJSON']);
			LE::writeUnsignedInt($out, $v['minPassingNeighbors']);
		}
	}
	private static function readWeightedTemperatureArray(ByteBufferReader $in) : array{

		$count = VarInt::readUnsignedInt($in);
		$list = [];

		for($i = 0; $i < $count; $i++){
			$list[] = [
				'temperature' => VarInt::readSignedInt($in),
				'weight' => LE::readUnsignedInt($in)
			];
		}

		return $list;
	}

	private static function writeWeightedTemperatureArray(ByteBufferWriter $out, array $list) : void{

		VarInt::writeUnsignedInt($out, count($list));

		foreach($list as $v){
			VarInt::writeSignedInt($out, $v['temperature']);
			LE::writeUnsignedInt($out, $v['weight']);
		}
	}
	private static function readLegacyWorldGenRules(ByteBufferReader $in) : array{

		$count = VarInt::readUnsignedInt($in);
		$list = [];

		for($i = 0; $i < $count; $i++){
			$list[] = self::readConditionalTransformation($in);
		}

		return $list;
	}

	private static function writeLegacyWorldGenRules(ByteBufferWriter $out, array $list) : void{

		VarInt::writeUnsignedInt($out, count($list));

		foreach($list as $v){
			self::writeConditionalTransformation($out, $v);
		}
	}

	private static function readConditionalTransformation(ByteBufferReader $in) : array{

		$weighted = self::readWeightedBiomeArray($in);

		return [
			'weightedBiomes' => $weighted,
			'conditionJSON' => LE::readSignedShort($in),
			'minPassingNeighbors' => LE::readUnsignedInt($in)
		];
	}

	private static function writeConditionalTransformation(ByteBufferWriter $out, array $v) : void{

		self::writeWeightedBiomeArray($out, $v['weightedBiomes']);

		LE::writeSignedShort($out, $v['conditionJSON']);
		LE::writeUnsignedInt($out, $v['minPassingNeighbors']);
	}
}