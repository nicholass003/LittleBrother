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

namespace Nicholass003\LittleBrother\Protocol\Translator\Handler;

use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketHandler;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\recipe\FurnaceRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\MultiRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\ShapedRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\ShapelessRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\SmithingTransformRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\SmithingTrimRecipe;
use function count;

final class CraftingDataPacketHandler extends ManualPacketHandler{

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		return $this->passthrough($in);
	}

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		$writer = new ByteBufferWriter();

		/*
		 * recipesWithTypeIds
		 */

		$recipeCount = VarInt::readUnsignedInt($in);

		$recipes = [];

		for($i = 0; $i < $recipeCount; ++$i){
			$type = VarInt::readSignedInt($in);

			$recipeWriter = new ByteBufferWriter();

			switch($type){
				case 0: // shapeless
				case 5:
				case 6:
					$recipe = ShapelessRecipe::decode($type, $in);

					VarInt::writeSignedInt($recipeWriter, $type);
					$recipe->encode($recipeWriter);

					$recipes[] = $recipeWriter->getData();
					break;
				case 1: // shaped
				case 7:
					$recipe = ShapedRecipe::decode($type, $in);

					VarInt::writeSignedInt($recipeWriter, $type);
					$recipe->encode($recipeWriter);

					$recipes[] = $recipeWriter->getData();
					break;
				case 2: // furnace
				case 3:
					$recipe = FurnaceRecipe::decode($type, $in);
					if($protocol < ProtocolVersion::BE_1_26_20){
						VarInt::writeSignedInt($recipeWriter, $type);
						$recipe->encode($recipeWriter);

						$recipes[] = $recipeWriter->getData();
					}
					break;
				case 4:
					$recipe = MultiRecipe::decode($type, $in);

					VarInt::writeSignedInt($recipeWriter, $type);
					$recipe->encode($recipeWriter);

					$recipes[] = $recipeWriter->getData();
					break;
				case 8:
					$recipe = SmithingTransformRecipe::decode($type, $in);

					VarInt::writeSignedInt($recipeWriter, $type);
					$recipe->encode($recipeWriter);

					$recipes[] = $recipeWriter->getData();
					break;
				case 9:
					$recipe = SmithingTrimRecipe::decode($type, $in);

					VarInt::writeSignedInt($recipeWriter, $type);
					$recipe->encode($recipeWriter);

					$recipes[] = $recipeWriter->getData();
					break;

				default:
					throw new \RuntimeException("Unknown recipe type $type");
			}
		}

		VarInt::writeUnsignedInt($writer, count($recipes));

		foreach($recipes as $recipeData){
			$writer->writeByteArray($recipeData);
		}

		/*
		 * potionTypeRecipes
		 */

		$count = VarInt::readUnsignedInt($in);

		VarInt::writeUnsignedInt($writer, $count);

		for($i = 0; $i < $count; ++$i){

			$inputId = VarInt::readSignedInt($in);
			$inputMeta = VarInt::readSignedInt($in);
			$ingredientId = VarInt::readSignedInt($in);
			$ingredientMeta = VarInt::readSignedInt($in);
			$outputId = VarInt::readSignedInt($in);
			$outputMeta = VarInt::readSignedInt($in);

			VarInt::writeSignedInt($writer, $inputId);
			VarInt::writeSignedInt($writer, $inputMeta);
			VarInt::writeSignedInt($writer, $ingredientId);
			VarInt::writeSignedInt($writer, $ingredientMeta);
			VarInt::writeSignedInt($writer, $outputId);
			VarInt::writeSignedInt($writer, $outputMeta);
		}

		/*
		 * potionContainerRecipes
		 */

		$count = VarInt::readUnsignedInt($in);

		VarInt::writeUnsignedInt($writer, $count);

		for($i = 0; $i < $count; ++$i){

			$input = VarInt::readSignedInt($in);
			$ingredient = VarInt::readSignedInt($in);
			$output = VarInt::readSignedInt($in);

			VarInt::writeSignedInt($writer, $input);
			VarInt::writeSignedInt($writer, $ingredient);
			VarInt::writeSignedInt($writer, $output);
		}

		/*
		 * materialReducerRecipes
		 */

		$count = VarInt::readUnsignedInt($in);

		VarInt::writeUnsignedInt($writer, $count);

		for($i = 0; $i < $count; ++$i){

			$inputIdAndMeta = VarInt::readSignedInt($in);

			VarInt::writeSignedInt($writer, $inputIdAndMeta);

			$outputCount = VarInt::readUnsignedInt($in);

			VarInt::writeUnsignedInt($writer, $outputCount);

			for($j = 0; $j < $outputCount; ++$j){

				$itemId = VarInt::readSignedInt($in);
				$count = VarInt::readSignedInt($in);

				VarInt::writeSignedInt($writer, $itemId);
				VarInt::writeSignedInt($writer, $count);
			}
		}

		/*
		 * cleanRecipes
		 */

		CommonTypes::putBool(
			$writer,
			CommonTypes::getBool($in)
		);

		return $writer->getData();
	}
}