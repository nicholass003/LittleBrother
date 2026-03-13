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

use Nicholass003\LittleBrother\Types\Biome\BiomeChunkGenParser;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\color\Color;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\AbilitiesData;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\utils\Binary;
use function array_merge;
use function count;
use function ord;
use function pack;
use function str_split;
use function unpack;

final class ManualTypeRegistry{

	public static function register(TypeRegistry $registry) : void{
		self::registerCacheableNbt($registry);
		self::registerOptionalServerJoinInformation($registry);
		self::registerAbilitiesLayer($registry);
		self::registerItemStackRequest($registry);
		self::registerAttributeModifier($registry);
		self::registerChainedSubCommandValueRawData($registry);
		self::registerItemTypeEntry($registry);
		self::registerCommandEnumConstraint($registry);
		self::registerCommandOverload($registry);
		self::registerCommandEnumValueIndex($registry);
		self::registerChangedSlot($registry);
		self::registerCommandSoftEnumValue($registry);
		self::registerOptionalBiomeDefinitionTags($registry);
		self::registerOptionalBiomeDefinitionChunkGenData($registry);
		self::registerOptionalLEUnsignedInt($registry);

		self::registerBeU32($registry);
		self::registerRotationByte($registry);
		self::registerEntityLink($registry);
		self::registerAttribute($registry);
		self::registerGameRules($registry);
		self::registerCommandOriginData($registry);
		self::registerGetCommandMessage($registry);
		self::registerStructureSettings($registry);
		self::registerStructureEditorData($registry);
		self::registerDimensionData($registry);
		self::registerChunkCacheBlob($registry);
		self::registerMapDecoration($registry);
		self::registerMapImage($registry);
		self::registerItemStack($registry);
		self::registerRecipeIngredient($registry);
		self::registerRecipeUnlockingRequirement($registry);
		self::registerPotionTypeRecipe($registry);
		self::registerPotionContainerChangeRecipe($registry);
		self::registerMaterialReducerRecipe($registry);
		self::registerTransactionData($registry);
		self::registerPackSettings($registry);
		self::registerSerializableVoxelCells($registry);
		self::registerCameraSplineInstruction($registry);
		self::registerCameraAimAssistCategoryPriorities($registry);
		self::registerCameraAimAssistPresetExclusionDefinition($registry);
		self::registerCameraAimAssistPresetItemSettings($registry);
		self::registerPlayerListEntry($registry);
		self::registerUpdateAbilitiesPacket($registry);
	}

	private static function registerCacheableNbt(TypeRegistry $registry) : void{
		$registry->register(
			'cacheable_nbt',
			reader: static function(ByteBufferReader $in, int $protocol) : string{
				return (new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt();
			},
			writer: static function(ByteBufferWriter $out, string $bytes, int $protocol) : void{
				$out->writeByteArray($bytes);
			}
		);
	}

	private static function registerBeU32(TypeRegistry $registry) : void{
		$registry->register(
			'be:u32',
			reader: static function(ByteBufferReader $in, int $protocol) : int{
				$bytes = $in->readByteArray(4);
				[, $val] = unpack('N', $bytes);
				return $val;
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol) : void{
				$out->writeByteArray(pack('N', $v));
			}
		);
	}

	private static function registerRotationByte(TypeRegistry $registry) : void{
		$registry->register(
			'rotation_byte',
			reader: static function(ByteBufferReader $in, int $protocol) : float{
				return CommonTypes::getRotationByte($in);
			},
			writer: static function(ByteBufferWriter $out, float $v, int $protocol) : void{
				CommonTypes::putRotationByte($out, $v);
			}
		);
	}

	private static function registerEntityLink(TypeRegistry $registry) : void{
		$registry->register(
			'entity_link',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'fromActorUniqueId' => CommonTypes::getActorUniqueId($in),
					'toActorUniqueId' => CommonTypes::getActorUniqueId($in),
					'type' => Byte::readUnsigned($in),
					'immediate' => CommonTypes::getBool($in),
					'causedByRider' => CommonTypes::getBool($in),
					'vehicleAngularVelocity' => LE::readFloat($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putActorUniqueId($out, $v['fromActorUniqueId']);
				CommonTypes::putActorUniqueId($out, $v['toActorUniqueId']);
				Byte::writeUnsigned($out, $v['type']);
				CommonTypes::putBool($out, $v['immediate']);
				CommonTypes::putBool($out, $v['causedByRider']);
				LE::writeFloat($out, $v['vehicleAngularVelocity']);
			}
		);
	}

	private static function registerAttribute(TypeRegistry $registry) : void{
		$registry->register(
			'attribute',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$min = LE::readFloat($in);
				$max = LE::readFloat($in);
				$current = LE::readFloat($in);
				$defaultMin = LE::readFloat($in);
				$defaultMax = LE::readFloat($in);
				$default = LE::readFloat($in);
				$id = CommonTypes::getString($in);
				$modifiers = [];
				$modCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $modCount; $i++){
					$modifiers[] = [
						'id' => CommonTypes::getString($in),
						'name' => CommonTypes::getString($in),
						'amount' => LE::readFloat($in),
						'operation' => LE::readSignedInt($in),
						'operand' => LE::readSignedInt($in),
						'serializable' => CommonTypes::getBool($in),
					];
				}
				return [
					'min' => $min,
					'max' => $max,
					'current' => $current,
					'defaultMin' => $defaultMin,
					'defaultMax' => $defaultMax,
					'default' => $default,
					'id' => $id,
					'modifiers' => $modifiers,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				LE::writeFloat($out, $v['min']);
				LE::writeFloat($out, $v['max']);
				LE::writeFloat($out, $v['current']);
				LE::writeFloat($out, $v['defaultMin']);
				LE::writeFloat($out, $v['defaultMax']);
				LE::writeFloat($out, $v['default']);
				CommonTypes::putString($out, $v['id']);
				VarInt::writeUnsignedInt($out, count($v['modifiers']));
				foreach($v['modifiers'] as $mod){
					CommonTypes::putString($out, $mod['id']);
					CommonTypes::putString($out, $mod['name']);
					LE::writeFloat($out, $mod['amount']);
					LE::writeSignedInt($out, $mod['operation']);
					LE::writeSignedInt($out, $mod['operand']);
					CommonTypes::putBool($out, $mod['serializable']);
				}
			}
		);
	}

	private static function registerGameRules(TypeRegistry $registry) : void{
		$registry->register(
			'game_rules',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return CommonTypes::getGameRules($in, false);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putGameRules($out, $v, false);
			}
		);
	}

	private static function registerCommandOriginData(TypeRegistry $registry) : void{
		$registry->register(
			'command_origin_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'type' => CommonTypes::getString($in),
					'uuid' => CommonTypes::getUUID($in),
					'requestId' => CommonTypes::getString($in),
					'playerActorUniqueId' => LE::readSignedLong($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['type']);
				CommonTypes::putUUID($out, $v['uuid']);
				CommonTypes::putString($out, $v['requestId']);
				LE::writeSignedLong($out, $v['playerActorUniqueId']);
			}
		);
	}

	private static function registerGetCommandMessage(TypeRegistry $registry) : void{
		$registry->register(
			'get_command_message',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$success = CommonTypes::getBool($in);
				$messageId = CommonTypes::getString($in);
				$params = [];
				$paramCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $paramCount; $i++){
					$params[] = CommonTypes::getString($in);
				}
				return [
					'success' => $success,
					'messageId' => $messageId,
					'params' => $params,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putBool($out, $v['success']);
				CommonTypes::putString($out, $v['messageId']);
				VarInt::writeUnsignedInt($out, count($v['params']));
				foreach($v['params'] as $param){
					CommonTypes::putString($out, $param);
				}
			}
		);
	}

	private static function registerStructureSettings(TypeRegistry $registry) : void{
		$registry->register(
			'structure_settings',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'paletteName' => CommonTypes::getString($in),
					'ignoreEntities' => CommonTypes::getBool($in),
					'ignoreBlocks' => CommonTypes::getBool($in),
					'allowNonTickingChunks' => CommonTypes::getBool($in),
					'dimensions' => CommonTypes::getBlockPosition($in),
					'offset' => CommonTypes::getBlockPosition($in),
					'lastTouchedByPlayerID' => CommonTypes::getActorUniqueId($in),
					'rotation' => Byte::readUnsigned($in),
					'mirror' => Byte::readUnsigned($in),
					'animationMode' => Byte::readUnsigned($in),
					'animationSeconds' => LE::readFloat($in),
					'integrityValue' => LE::readFloat($in),
					'integritySeed' => LE::readUnsignedInt($in),
					'pivot' => CommonTypes::getVector3($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['paletteName']);
				CommonTypes::putBool($out, $v['ignoreEntities']);
				CommonTypes::putBool($out, $v['ignoreBlocks']);
				CommonTypes::putBool($out, $v['allowNonTickingChunks']);
				CommonTypes::putBlockPosition($out, $v['dimensions']);
				CommonTypes::putBlockPosition($out, $v['offset']);
				CommonTypes::putActorUniqueId($out, $v['lastTouchedByPlayerID']);
				Byte::writeUnsigned($out, $v['rotation']);
				Byte::writeUnsigned($out, $v['mirror']);
				Byte::writeUnsigned($out, $v['animationMode']);
				LE::writeFloat($out, $v['animationSeconds']);
				LE::writeFloat($out, $v['integrityValue']);
				LE::writeUnsignedInt($out, $v['integritySeed']);
				CommonTypes::putVector3($out, $v['pivot']);
			}
		);
	}

	private static function registerStructureEditorData(TypeRegistry $registry) : void{
		$registry->register(
			'structure_editor_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'structureName' => CommonTypes::getString($in),
					'filteredStructureName' => CommonTypes::getString($in),
					'structureDataField' => CommonTypes::getString($in),
					'includePlayers' => CommonTypes::getBool($in),
					'showBoundingBox' => CommonTypes::getBool($in),
					'structureBlockType' => VarInt::readSignedInt($in),
					'structureSettings' => self::readStructureSettingsInline($in),
					'structureRedstoneSaveMode' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['structureName']);
				CommonTypes::putString($out, $v['filteredStructureName']);
				CommonTypes::putString($out, $v['structureDataField']);
				CommonTypes::putBool($out, $v['includePlayers']);
				CommonTypes::putBool($out, $v['showBoundingBox']);
				VarInt::writeSignedInt($out, $v['structureBlockType']);
				self::writeStructureSettingsInline($out, $v['structureSettings']);
				VarInt::writeSignedInt($out, $v['structureRedstoneSaveMode']);
			}
		);
	}

	private static function readStructureSettingsInline(ByteBufferReader $in) : array{
		return [
			'paletteName' => CommonTypes::getString($in),
			'ignoreEntities' => CommonTypes::getBool($in),
			'ignoreBlocks' => CommonTypes::getBool($in),
			'allowNonTickingChunks' => CommonTypes::getBool($in),
			'dimensions' => CommonTypes::getBlockPosition($in),
			'offset' => CommonTypes::getBlockPosition($in),
			'lastTouchedByPlayerID' => CommonTypes::getActorUniqueId($in),
			'rotation' => Byte::readUnsigned($in),
			'mirror' => Byte::readUnsigned($in),
			'animationMode' => Byte::readUnsigned($in),
			'animationSeconds' => LE::readFloat($in),
			'integrityValue' => LE::readFloat($in),
			'integritySeed' => LE::readUnsignedInt($in),
			'pivot' => CommonTypes::getVector3($in),
		];
	}

	private static function writeStructureSettingsInline(ByteBufferWriter $out, array $v) : void{
		CommonTypes::putString($out, $v['paletteName']);
		CommonTypes::putBool($out, $v['ignoreEntities']);
		CommonTypes::putBool($out, $v['ignoreBlocks']);
		CommonTypes::putBool($out, $v['allowNonTickingChunks']);
		CommonTypes::putBlockPosition($out, $v['dimensions']);
		CommonTypes::putBlockPosition($out, $v['offset']);
		CommonTypes::putActorUniqueId($out, $v['lastTouchedByPlayerID']);
		Byte::writeUnsigned($out, $v['rotation']);
		Byte::writeUnsigned($out, $v['mirror']);
		Byte::writeUnsigned($out, $v['animationMode']);
		LE::writeFloat($out, $v['animationSeconds']);
		LE::writeFloat($out, $v['integrityValue']);
		LE::writeUnsignedInt($out, $v['integritySeed']);
		CommonTypes::putVector3($out, $v['pivot']);
	}

	private static function registerDimensionData(TypeRegistry $registry) : void{
		$registry->register(
			'dimension_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'maxHeight' => VarInt::readSignedInt($in),
					'minHeight' => VarInt::readSignedInt($in),
					'generator' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				VarInt::writeSignedInt($out, $v['maxHeight']);
				VarInt::writeSignedInt($out, $v['minHeight']);
				VarInt::writeSignedInt($out, $v['generator']);
			}
		);
	}

	private static function registerChunkCacheBlob(TypeRegistry $registry) : void{
		$registry->register(
			'chunk_cache_blob',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$hash = LE::readUnsignedLong($in);
				$payload = CommonTypes::getString($in);
				return ['hash' => $hash, 'payload' => $payload];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				LE::writeUnsignedLong($out, $v['hash']);
				CommonTypes::putString($out, $v['payload']);
			}
		);
	}

	private static function registerMapDecoration(TypeRegistry $registry) : void{
		$registry->register(
			'map_decoration',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'icon' => Byte::readUnsigned($in),
					'rotation' => Byte::readUnsigned($in),
					'xOffset' => Byte::readUnsigned($in),
					'yOffset' => Byte::readUnsigned($in),
					'label' => CommonTypes::getString($in),
					// color: RGBA stored as flipped-endian uvarint
					'color' => Binary::flipIntEndianness(VarInt::readUnsignedInt($in)),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				Byte::writeUnsigned($out, $v['icon']);
				Byte::writeUnsigned($out, $v['rotation']);
				Byte::writeUnsigned($out, $v['xOffset']);
				Byte::writeUnsigned($out, $v['yOffset']);
				CommonTypes::putString($out, $v['label']);
				VarInt::writeUnsignedInt($out, Binary::flipIntEndianness($v['color']));
			}
		);
	}

	private static function registerMapImage(TypeRegistry $registry) : void{
		$registry->register(
			'map_image',
			reader: static function(ByteBufferReader $in, int $protocol) : string{
				return $in->readByteArray($in->getUnreadLength());
			},
			writer: static function(ByteBufferWriter $out, string $v, int $protocol) : void{
				$out->writeByteArray($v);
			}
		);
	}

	private static function registerItemStack(TypeRegistry $registry) : void{
		$registry->register(
			'item_stack',
			reader: static function(ByteBufferReader $in, int $protocol) : mixed{
				return CommonTypes::getItemStackWithoutStackId($in);
			},
			writer: static function(ByteBufferWriter $out, mixed $v, int $protocol) : void{
				CommonTypes::putItemStackWithoutStackId($out, $v);
			}
		);
	}

	private static function registerRecipeIngredient(TypeRegistry $registry) : void{
		$registry->register(
			'recipe_ingredient',
			reader: static function(ByteBufferReader $in, int $protocol) : mixed{
				return CommonTypes::getRecipeIngredient($in);
			},
			writer: static function(ByteBufferWriter $out, mixed $v, int $protocol) : void{
				CommonTypes::putRecipeIngredient($out, $v);
			}
		);
	}

	private static function registerRecipeUnlockingRequirement(TypeRegistry $registry) : void{
		$registry->register(
			'recipe_unlocking_requirement',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				// bool true  → null (always-unlocked)
				// bool false → list<RecipeIngredient>
				$isAlwaysUnlocked = CommonTypes::getBool($in);
				if($isAlwaysUnlocked){
					return ['alwaysUnlocked' => true, 'ingredients' => []];
				}
				$ingredients = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$ingredients[] = CommonTypes::getRecipeIngredient($in);
				}
				return ['alwaysUnlocked' => false, 'ingredients' => $ingredients];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putBool($out, $v['alwaysUnlocked']);
				if(!$v['alwaysUnlocked']){
					VarInt::writeUnsignedInt($out, count($v['ingredients']));
					foreach($v['ingredients'] as $ingredient){
						CommonTypes::putRecipeIngredient($out, $ingredient);
					}
				}
			}
		);
	}

	private static function registerPotionTypeRecipe(TypeRegistry $registry) : void{
		$registry->register(
			'potion_type_recipe',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'inputItemId' => VarInt::readSignedInt($in),
					'inputItemMeta' => VarInt::readSignedInt($in),
					'ingredientItemId' => VarInt::readSignedInt($in),
					'ingredientItemMeta' => VarInt::readSignedInt($in),
					'outputItemId' => VarInt::readSignedInt($in),
					'outputItemMeta' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				VarInt::writeSignedInt($out, $v['inputItemId']);
				VarInt::writeSignedInt($out, $v['inputItemMeta']);
				VarInt::writeSignedInt($out, $v['ingredientItemId']);
				VarInt::writeSignedInt($out, $v['ingredientItemMeta']);
				VarInt::writeSignedInt($out, $v['outputItemId']);
				VarInt::writeSignedInt($out, $v['outputItemMeta']);
			}
		);
	}

	private static function registerPotionContainerChangeRecipe(TypeRegistry $registry) : void{
		$registry->register(
			'potion_container_change_recipe',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'inputItemId' => VarInt::readSignedInt($in),
					'ingredientItemId' => VarInt::readSignedInt($in),
					'outputItemId' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				VarInt::writeSignedInt($out, $v['inputItemId']);
				VarInt::writeSignedInt($out, $v['ingredientItemId']);
				VarInt::writeSignedInt($out, $v['outputItemId']);
			}
		);
	}

	private static function registerMaterialReducerRecipe(TypeRegistry $registry) : void{
		$registry->register(
			'material_reducer_recipe',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$inputIdAndData = VarInt::readSignedInt($in);
				$inputId = $inputIdAndData >> 16;
				$inputMeta = $inputIdAndData & 0x7FFF;
				$outputs = [];
				$outCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $outCount; $i++){
					$outputs[] = [
						'itemId' => VarInt::readSignedInt($in),
						'count' => VarInt::readSignedInt($in),
					];
				}
				return [
					'inputItemId' => $inputId,
					'inputItemMeta' => $inputMeta,
					'outputs' => $outputs,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				VarInt::writeSignedInt($out, ($v['inputItemId'] << 16) | $v['inputItemMeta']);
				VarInt::writeUnsignedInt($out, count($v['outputs']));
				foreach($v['outputs'] as $output){
					VarInt::writeSignedInt($out, $output['itemId']);
					VarInt::writeSignedInt($out, $output['count']);
				}
			}
		);
	}

	private static function registerTransactionData(TypeRegistry $registry) : void{
		$registry->register(
			'normal_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return self::readNetworkInventoryActions($in, $protocol);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol);
			}
		);

		$registry->register(
			'mismatch_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return self::readNetworkInventoryActions($in, $protocol);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol);
			}
		);

		$registry->register(
			'use_item_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$base = self::readNetworkInventoryActions($in, $protocol);
				return array_merge($base, [
					'actionType' => VarInt::readUnsignedInt($in),
					'triggerType' => VarInt::readUnsignedInt($in),
					'blockPosition' => CommonTypes::getBlockPosition($in),
					'face' => VarInt::readSignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'playerPosition' => CommonTypes::getVector3($in),
					'clickPosition' => CommonTypes::getVector3($in),
					'blockRuntimeId' => VarInt::readUnsignedInt($in),
					'clientInteractPrediction' => VarInt::readUnsignedInt($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol);
				VarInt::writeUnsignedInt($out, $v['actionType']);
				VarInt::writeUnsignedInt($out, $v['triggerType']);
				CommonTypes::putBlockPosition($out, $v['blockPosition']);
				VarInt::writeSignedInt($out, $v['face']);
				VarInt::writeSignedInt($out, $v['hotbarSlot']);
				CommonTypes::putItemStackWrapper($out, $v['itemInHand']);
				CommonTypes::putVector3($out, $v['playerPosition']);
				CommonTypes::putVector3($out, $v['clickPosition']);
				VarInt::writeUnsignedInt($out, $v['blockRuntimeId']);
				VarInt::writeUnsignedInt($out, $v['clientInteractPrediction']);
			}
		);

		$registry->register(
			'use_item_on_entity_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$base = self::readNetworkInventoryActions($in, $protocol);
				return array_merge($base, [
					'actorRuntimeId' => CommonTypes::getActorRuntimeId($in),
					'actionType' => VarInt::readUnsignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'playerPosition' => CommonTypes::getVector3($in),
					'clickPosition' => CommonTypes::getVector3($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol);
				CommonTypes::putActorRuntimeId($out, $v['actorRuntimeId']);
				VarInt::writeUnsignedInt($out, $v['actionType']);
				VarInt::writeSignedInt($out, $v['hotbarSlot']);
				CommonTypes::putItemStackWrapper($out, $v['itemInHand']);
				CommonTypes::putVector3($out, $v['playerPosition']);
				CommonTypes::putVector3($out, $v['clickPosition']);
			}
		);

		$registry->register(
			'release_item_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$base = self::readNetworkInventoryActions($in, $protocol);
				return array_merge($base, [
					'actionType' => VarInt::readUnsignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'headPosition' => CommonTypes::getVector3($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol);
				VarInt::writeUnsignedInt($out, $v['actionType']);
				VarInt::writeSignedInt($out, $v['hotbarSlot']);
				CommonTypes::putItemStackWrapper($out, $v['itemInHand']);
				CommonTypes::putVector3($out, $v['headPosition']);
			}
		);
	}

	private static function readNetworkInventoryActions(ByteBufferReader $in, int $protocol) : array{
		$actions = [];
		$count = VarInt::readUnsignedInt($in);
		for($i = 0; $i < $count; $i++){
			$sourceType = VarInt::readUnsignedInt($in);
			$windowId = 0;
			$sourceFlags = 0;
			switch($sourceType){
				case 0: // SOURCE_CONTAINER
				case 99999: // SOURCE_TODO
					$windowId = VarInt::readSignedInt($in);
					break;
				case 2: // SOURCE_WORLD
					$sourceFlags = VarInt::readUnsignedInt($in);
					break;
				case 3: // SOURCE_CREATIVE
					break;
			}
			$actions[] = [
				'sourceType' => $sourceType,
				'windowId' => $windowId,
				'sourceFlags' => $sourceFlags,
				'inventorySlot' => VarInt::readUnsignedInt($in),
				'oldItem' => CommonTypes::getItemStackWrapper($in),
				'newItem' => CommonTypes::getItemStackWrapper($in),
			];
		}
		return ['actions' => $actions];
	}

	private static function writeNetworkInventoryActions(ByteBufferWriter $out, array $actions, int $protocol) : void{
		VarInt::writeUnsignedInt($out, count($actions));
		foreach($actions as $action){
			VarInt::writeUnsignedInt($out, $action['sourceType']);
			switch($action['sourceType']){
				case 0:
				case 99999:
					VarInt::writeSignedInt($out, $action['windowId']);
					break;
				case 2:
					VarInt::writeUnsignedInt($out, $action['sourceFlags']);
					break;
				case 3:
					break;
			}
			VarInt::writeUnsignedInt($out, $action['inventorySlot']);
			CommonTypes::putItemStackWrapper($out, $action['oldItem']);
			CommonTypes::putItemStackWrapper($out, $action['newItem']);
		}
	}

	private static function registerPackSettings(TypeRegistry $registry) : void{
		$registry->register(
			'float_pack_setting',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::FLOAT = 0
				$value = LE::readFloat($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				LE::writeFloat($out, $v['value']);
			}
		);

		$registry->register(
			'bool_pack_setting',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::BOOL = 1
				$value = CommonTypes::getBool($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				CommonTypes::putBool($out, $v['value']);
			}
		);

		$registry->register(
			'string_pack_setting',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::STRING = 2
				$value = CommonTypes::getString($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				CommonTypes::putString($out, $v['value']);
			}
		);
	}

	private static function registerSerializableVoxelCells(TypeRegistry $registry) : void{
		$registry->register(
			'serializable_voxel_cells',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$xSize = Byte::readUnsigned($in);
				$ySize = Byte::readUnsigned($in);
				$zSize = Byte::readUnsigned($in);
				$storage = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$storage[] = Byte::readUnsigned($in);
				}
				return [
					'xSize' => $xSize,
					'ySize' => $ySize,
					'zSize' => $zSize,
					'storage' => $storage,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				Byte::writeUnsigned($out, $v['xSize']);
				Byte::writeUnsigned($out, $v['ySize']);
				Byte::writeUnsigned($out, $v['zSize']);
				VarInt::writeUnsignedInt($out, count($v['storage']));
				foreach($v['storage'] as $byte){
					Byte::writeUnsigned($out, $byte);
				}
			}
		);
	}

	private static function registerCameraSplineInstruction(TypeRegistry $registry) : void{
		$registry->register(
			'camera_spline_instruction',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$totalTime = LE::readFloat($in);
				$easeType = Byte::readUnsigned($in);

				$curve = [];
				$curveCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $curveCount; $i++){
					$curve[] = CommonTypes::getVector3($in);
				}

				$progressKeyFrames = [];
				$progressCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $progressCount; $i++){
					$progressKeyFrames[] = [
						'value' => LE::readFloat($in),
						'time' => LE::readFloat($in),
						'easeType' => LE::readUnsignedInt($in),
					];
				}

				$rotationOptions = [];
				$rotationCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $rotationCount; $i++){
					$rotationOptions[] = [
						'value' => CommonTypes::getVector3($in),
						'time' => LE::readFloat($in),
					];
				}

				return [
					'totalTime' => $totalTime,
					'easeType' => $easeType,
					'curve' => $curve,
					'progressKeyFrames' => $progressKeyFrames,
					'rotationOptions' => $rotationOptions,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				LE::writeFloat($out, $v['totalTime']);
				Byte::writeUnsigned($out, $v['easeType']);

				VarInt::writeUnsignedInt($out, count($v['curve']));
				foreach($v['curve'] as $point){
					CommonTypes::putVector3($out, $point);
				}

				VarInt::writeUnsignedInt($out, count($v['progressKeyFrames']));
				foreach($v['progressKeyFrames'] as $kf){
					LE::writeFloat($out, $kf['value']);
					LE::writeFloat($out, $kf['time']);
					LE::writeUnsignedInt($out, $kf['easeType']);
				}

				VarInt::writeUnsignedInt($out, count($v['rotationOptions']));
				foreach($v['rotationOptions'] as $opt){
					CommonTypes::putVector3($out, $opt['value']);
					LE::writeFloat($out, $opt['time']);
				}
			}
		);
	}

	private static function registerCameraAimAssistCategoryPriorities(TypeRegistry $registry) : void{
		$registry->register(
			'camera_aim_assist_category_priorities',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$readList = static function(ByteBufferReader $in) : array{
					$items = [];
					$count = VarInt::readUnsignedInt($in);
					for($i = 0; $i < $count; $i++){
						$items[] = [
							'identifier' => CommonTypes::getString($in),
							'priority' => LE::readSignedInt($in),
						];
					}
					return $items;
				};
				return [
					'entities' => $readList($in),
					'blocks' => $readList($in),
					'blockTags' => $readList($in),
					'entityTypeFamilies' => $readList($in),
					'defaultEntityPriority' => CommonTypes::readOptional($in, LE::readSignedInt(...)),
					'defaultBlockPriority' => CommonTypes::readOptional($in, LE::readSignedInt(...)),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				$writeList = static function(ByteBufferWriter $out, array $items) : void{
					VarInt::writeUnsignedInt($out, count($items));
					foreach($items as $item){
						CommonTypes::putString($out, $item['identifier']);
						LE::writeSignedInt($out, $item['priority']);
					}
				};
				$writeList($out, $v['entities']);
				$writeList($out, $v['blocks']);
				$writeList($out, $v['blockTags']);
				$writeList($out, $v['entityTypeFamilies']);
				CommonTypes::writeOptional($out, $v['defaultEntityPriority'], LE::writeSignedInt(...));
				CommonTypes::writeOptional($out, $v['defaultBlockPriority'], LE::writeSignedInt(...));
			}
		);
	}

	private static function registerCameraAimAssistPresetExclusionDefinition(TypeRegistry $registry) : void{
		$registry->register(
			'camera_aim_assist_preset_exclusion_definition',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$readStringList = static function(ByteBufferReader $in) : array{
					$items = [];
					$count = VarInt::readUnsignedInt($in);
					for($i = 0; $i < $count; $i++){
						$items[] = CommonTypes::getString($in);
					}
					return $items;
				};
				return [
					'blocks' => $readStringList($in),
					'entities' => $readStringList($in),
					'blockTags' => $readStringList($in),
					'entityTypeFamilies' => $readStringList($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				$writeStringList = static function(ByteBufferWriter $out, array $items) : void{
					VarInt::writeUnsignedInt($out, count($items));
					foreach($items as $s){
						CommonTypes::putString($out, $s);
					}
				};
				$writeStringList($out, $v['blocks']);
				$writeStringList($out, $v['entities']);
				$writeStringList($out, $v['blockTags']);
				$writeStringList($out, $v['entityTypeFamilies']);
			}
		);
	}

	private static function registerCameraAimAssistPresetItemSettings(TypeRegistry $registry) : void{
		$registry->register(
			'camera_aim_assist_preset_item_settings',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'itemIdentifier' => CommonTypes::getString($in),
					'categoryName' => CommonTypes::getString($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['itemIdentifier']);
				CommonTypes::putString($out, $v['categoryName']);
			}
		);
	}

	private static function registerOptionalServerJoinInformation(TypeRegistry $registry) : void{
		$registry->register(
			'server_join_information',
			reader: static function(ByteBufferReader $in, int $protocol) : string{
				$hasValueByte = $in->readByteArray(1);
				$hasValue = ord($hasValueByte) !== 0;
				if(!$hasValue) return $hasValueByte;
				$lenBytes = '';
				$shift = 0;
				$strLen = 0;
				do{
					$b = $in->readByteArray(1);
					$lenBytes .= $b;
					$bVal = ord($b);
					$strLen |= ($bVal & 0x7F) << $shift;
					$shift += 7;
				} while($bVal & 0x80);
				$strBytes = $strLen > 0 ? $in->readByteArray($strLen) : '';
				$boolByte = $in->readByteArray(1);
				return $hasValueByte . $lenBytes . $strBytes . $boolByte;
			},
			writer: static function(ByteBufferWriter $out, string $rawBytes, int $protocol) : void{
				foreach(str_split($rawBytes) as $byte){
					Byte::writeUnsigned($out, ord($byte));
				}
			}
		);
	}

	private static function registerAbilitiesLayer(TypeRegistry $registry) : void{
		$registry->register(
			'abilities_layer',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'layerId' => LE::readUnsignedShort($in),
					'setAbilities' => LE::readUnsignedInt($in),
					'setAbilitiesValue' => LE::readUnsignedInt($in),
					'flySpeed' => LE::readFloat($in),
					'verticalFlySpeed' => LE::readFloat($in),
					'walkSpeed' => LE::readFloat($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				LE::writeUnsignedShort($out, $v['layerId']);
				LE::writeUnsignedInt($out, $v['setAbilities']);
				LE::writeUnsignedInt($out, $v['setAbilitiesValue']);
				LE::writeFloat($out, $v['flySpeed']);
				LE::writeFloat($out, $v['verticalFlySpeed']);
				LE::writeFloat($out, $v['walkSpeed']);
			}
		);
	}

	private static function registerItemStackRequest(TypeRegistry $registry) : void{
		$registry->register(
			'item_stack_request',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$requestId = CommonTypes::readItemStackRequestId($in);
				$actions = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$typeId = Byte::readUnsigned($in);
					$actions[] = ['typeId' => $typeId, 'payload' => self::readActionPayload($in, $typeId, $protocol)];
				}
				$filterStrings = [];
				$filterCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $filterCount; $i++){
					$filterStrings[] = CommonTypes::getString($in);
				}
				return [
					'requestId' => $requestId,
					'actions' => $actions,
					'filterStrings' => $filterStrings,
					'filterCause' => LE::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::writeItemStackRequestId($out, $v['requestId']);
				VarInt::writeUnsignedInt($out, count($v['actions']));
				foreach($v['actions'] as $action){
					Byte::writeUnsigned($out, $action['typeId']);
					self::writeActionPayload($out, $action['typeId'], $action['payload'], $protocol);
				}
				VarInt::writeUnsignedInt($out, count($v['filterStrings']));
				foreach($v['filterStrings'] as $s) CommonTypes::putString($out, $s);
				LE::writeSignedInt($out, $v['filterCause']);
			}
		);
	}

	private static function registerAttributeModifier(TypeRegistry $registry) : void{
		$registry->register(
			'attribute_modifier',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'id' => CommonTypes::getString($in),
					'name' => CommonTypes::getString($in),
					'amount' => LE::readFloat($in),
					'operation' => LE::readSignedInt($in),
					'operand' => LE::readSignedInt($in),
					'serializable' => CommonTypes::getBool($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['id']);
				CommonTypes::putString($out, $v['name']);
				LE::writeFloat($out, $v['amount']);
				LE::writeSignedInt($out, $v['operation']);
				LE::writeSignedInt($out, $v['operand']);
				CommonTypes::putBool($out, $v['serializable']);
			}
		);
	}

	private static function registerChainedSubCommandValueRawData(TypeRegistry $registry) : void{
		$registry->register(
			'chained_sub_command_value_raw_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'nameIndex' => VarInt::readUnsignedInt($in),
					'type' => VarInt::readUnsignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				VarInt::writeUnsignedInt($out, $v['nameIndex']);
				VarInt::writeUnsignedInt($out, $v['type']);
			}
		);
	}

	private static function registerItemTypeEntry(TypeRegistry $registry) : void{
		$registry->register(
			'item_type_entry',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'stringId' => CommonTypes::getString($in),
					'numericId' => LE::readSignedShort($in),
					'isComponentBased' => CommonTypes::getBool($in),
					'version' => VarInt::readSignedInt($in),
					'nbt' => (new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt(),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putString($out, $v['stringId']);
				LE::writeSignedShort($out, $v['numericId']);
				CommonTypes::putBool($out, $v['isComponentBased']);
				VarInt::writeSignedInt($out, $v['version']);
				$out->writeByteArray($v['nbt']);
			}
		);
	}

	private static function registerCommandEnumConstraint(TypeRegistry $registry) : void{
		$registry->register(
			'command_enum_constraint',
			reader: static function(ByteBufferReader $in, int $protocol) : int{
				return Byte::readUnsigned($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol) : void{
				Byte::writeUnsigned($out, $v);
			}
		);
	}

	private static function registerCommandOverload(TypeRegistry $registry) : void{
		$registry->register(
			'command_overload_raw_data',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				$isChained = CommonTypes::getBool($in);
				$params = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$params[] = [
						'name' => CommonTypes::getString($in),
						'paramType' => LE::readUnsignedInt($in),
						'isOptional' => CommonTypes::getBool($in),
						'options' => Byte::readUnsigned($in),
					];
				}
				return ['isChained' => $isChained, 'params' => $params];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				CommonTypes::putBool($out, $v['isChained']);
				VarInt::writeUnsignedInt($out, count($v['params']));
				foreach($v['params'] as $p){
					CommonTypes::putString($out, $p['name']);
					LE::writeUnsignedInt($out, $p['paramType']);
					CommonTypes::putBool($out, $p['isOptional']);
					Byte::writeUnsigned($out, $p['options']);
				}
			}
		);
	}

	private static function registerCommandEnumValueIndex(TypeRegistry $registry) : void{
		$registry->register(
			'command_enum_value_index',
			reader: static function(ByteBufferReader $in, int $protocol) : int{
				return LE::readUnsignedInt($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol) : void{
				LE::writeUnsignedInt($out, $v);
			}
		);
	}

	private static function registerChangedSlot(TypeRegistry $registry) : void{
		$registry->register(
			'changed_slot',
			reader: static function(ByteBufferReader $in, int $protocol) : int{
				return Byte::readUnsigned($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol) : void{
				Byte::writeUnsigned($out, $v);
			}
		);
	}

	private static function registerCommandSoftEnumValue(TypeRegistry $registry) : void{
		$registry->register(
			'command_soft_enum_value',
			reader: static function(ByteBufferReader $in, int $protocol) : string{
				return CommonTypes::getString($in);
			},
			writer: static function(ByteBufferWriter $out, string $v, int $protocol) : void{
				CommonTypes::putString($out, $v);
			}
		);
	}

	private static function registerOptionalBiomeDefinitionTags(TypeRegistry $registry) : void{
		$registry->register(
			'biome_definition_tags',
			reader: static function(ByteBufferReader $in, int $protocol) : ?array{
				$hasValue = Byte::readUnsigned($in) !== 0;
				if(!$hasValue) return null;
				$tags = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$tags[] = LE::readUnsignedShort($in);
				}
				return $tags;
			},
			writer: static function(ByteBufferWriter $out, ?array $tags, int $protocol) : void{
				if($tags === null){ Byte::writeUnsigned($out, 0); return; }
				Byte::writeUnsigned($out, 1);
				VarInt::writeUnsignedInt($out, count($tags));
				foreach($tags as $tag) LE::writeUnsignedShort($out, $tag);
			}
		);
	}

	private static function registerOptionalBiomeDefinitionChunkGenData(TypeRegistry $registry) : void{
		$registry->register(
			'biome_definition_chunk_gen_data',
			reader: static function(ByteBufferReader $in, int $protocol) : ?array{
				return BiomeChunkGenParser::read($in, $protocol);
			},
			writer: static function(ByteBufferWriter $out, ?array $value, int $protocol) : void{
				BiomeChunkGenParser::write($out, $value, $protocol);
			}
		);
	}

	private static function registerOptionalLEUnsignedInt(TypeRegistry $registry) : void{
		$registry->register(
			'l_e',
			reader: static function(ByteBufferReader $in, int $protocol) : ?int{
				return CommonTypes::readOptional($in, LE::readUnsignedInt(...));
			},
			writer: static function(ByteBufferWriter $out, ?int $v, int $protocol) : void{
				CommonTypes::writeOptional($out, $v, LE::writeUnsignedInt(...));
			}
		);
	}

	private static function readActionPayload(ByteBufferReader $in, int $typeId, int $protocol) : array{
		return match($typeId){
			0, 1, 18, 19 => self::readSlotTransfer($in, $protocol),
			2 => self::readSlotSwap($in, $protocol),
			3 => self::readDrop($in, $protocol),
			4, 5 => self::readSingleSlot($in, $protocol),
			6 => ['resultIndex' => VarInt::readUnsignedInt($in)],
			8 => ['primaryEffect' => VarInt::readSignedInt($in), 'secondaryEffect' => VarInt::readSignedInt($in)],
			9 => ['hotbarSlot' => VarInt::readSignedInt($in), 'predictedDurability' => VarInt::readSignedInt($in), 'stackId' => CommonTypes::readItemStackNetIdVariant($in)],
			10 => ['recipeId' => CommonTypes::readRecipeNetId($in), 'repetitions' => Byte::readUnsigned($in)],
			11 => self::readCraftRecipeAuto($in, $protocol),
			12 => ['creativeItemNetId' => VarInt::readUnsignedInt($in)],
			13 => ['recipeId' => CommonTypes::readRecipeNetId($in), 'filterStringIndex' => LE::readSignedInt($in)],
			14 => ['creativeItemId' => CommonTypes::readCreativeItemNetId($in), 'repetitions' => Byte::readUnsigned($in)],
			16 => ['recipeId' => CommonTypes::readRecipeNetId($in), 'repairCost' => VarInt::readSignedInt($in), 'repetitions' => Byte::readUnsigned($in)],
			17 => ['patternId' => CommonTypes::getString($in), 'repetitions' => Byte::readUnsigned($in)],
			21 => self::readDeprecatedResults($in, $protocol),
			default => throw new \RuntimeException("Unknown ItemStackRequestAction typeId=$typeId"),
		};
	}

	private static function writeActionPayload(ByteBufferWriter $out, int $typeId, array $payload, int $protocol) : void{
		match($typeId){
			0, 1, 18, 19 => self::writeSlotTransfer($out, $payload, $protocol),
			2 => self::writeSlotSwap($out, $payload, $protocol),
			3 => self::writeDrop($out, $payload, $protocol),
			4, 5 => self::writeSingleSlot($out, $payload, $protocol),
			6 => VarInt::writeUnsignedInt($out, $payload['resultIndex']),
			8 => (static function() use($out, $payload){
								VarInt::writeSignedInt($out, $payload['primaryEffect']);
								VarInt::writeSignedInt($out, $payload['secondaryEffect']);
							})(),
			9 => (static function() use($out, $payload){
								VarInt::writeSignedInt($out, $payload['hotbarSlot']);
								VarInt::writeSignedInt($out, $payload['predictedDurability']);
								CommonTypes::writeItemStackNetIdVariant($out, $payload['stackId']);
							})(),
			10 => (static function() use($out, $payload){
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			11 => self::writeCraftRecipeAuto($out, $payload, $protocol),
			12 => VarInt::writeUnsignedInt($out, $payload['creativeItemNetId']),
			13 => (static function() use($out, $payload){
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								LE::writeSignedInt($out, $payload['filterStringIndex']);
							})(),
			14 => (static function() use($out, $payload){
								CommonTypes::writeCreativeItemNetId($out, $payload['creativeItemId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			16 => (static function() use($out, $payload){
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								VarInt::writeSignedInt($out, $payload['repairCost']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			17 => (static function() use($out, $payload){
								CommonTypes::putString($out, $payload['patternId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			21 => self::writeDeprecatedResults($out, $payload, $protocol),
			default => throw new \RuntimeException("Unknown ItemStackRequestAction typeId=$typeId"),
		};
	}

	private static function readSlotInfo(ByteBufferReader $in, int $protocol) : array{
		return ['containerId' => Byte::readUnsigned($in), 'dynamicContainerId' => VarInt::readUnsignedInt($in), 'slotId' => Byte::readUnsigned($in), 'stackId' => CommonTypes::readItemStackNetIdVariant($in)];
	}
	private static function writeSlotInfo(ByteBufferWriter $out, array $slot, int $protocol) : void{
		Byte::writeUnsigned($out, $slot['containerId']);
		VarInt::writeUnsignedInt($out, $slot['dynamicContainerId']);
		Byte::writeUnsigned($out, $slot['slotId']);
		CommonTypes::writeItemStackNetIdVariant($out, $slot['stackId']);
	}
	private static function readSlotTransfer(ByteBufferReader $in, int $protocol) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol), 'dst' => self::readSlotInfo($in, $protocol)];
	}
	private static function writeSlotTransfer(ByteBufferWriter $out, array $v, int $protocol) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol); self::writeSlotInfo($out, $v['dst'], $protocol);
	}
	private static function readSlotSwap(ByteBufferReader $in, int $protocol) : array{
		return ['src' => self::readSlotInfo($in, $protocol), 'dst' => self::readSlotInfo($in, $protocol)];
	}
	private static function writeSlotSwap(ByteBufferWriter $out, array $v, int $protocol) : void{
		self::writeSlotInfo($out, $v['src'], $protocol); self::writeSlotInfo($out, $v['dst'], $protocol);
	}
	private static function readDrop(ByteBufferReader $in, int $protocol) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol), 'randomDrop' => Byte::readUnsigned($in) !== 0];
	}
	private static function writeDrop(ByteBufferWriter $out, array $v, int $protocol) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol); Byte::writeUnsigned($out, $v['randomDrop'] ? 1 : 0);
	}
	private static function readSingleSlot(ByteBufferReader $in, int $protocol) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol)];
	}
	private static function writeSingleSlot(ByteBufferWriter $out, array $v, int $protocol) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol);
	}
	private static function readCraftRecipeAuto(ByteBufferReader $in, int $protocol) : array{
		$recipeId = CommonTypes::readRecipeNetId($in);
		$rep1 = Byte::readUnsigned($in);
		$rep2 = Byte::readUnsigned($in);
		$ingredients = [];
		$count = Byte::readUnsigned($in);
		for($i = 0; $i < $count; $i++) $ingredients[] = CommonTypes::getRecipeIngredient($in);
		return ['recipeId' => $recipeId, 'repetitions' => $rep1, 'repetitions2' => $rep2, 'ingredients' => $ingredients];
	}
	private static function writeCraftRecipeAuto(ByteBufferWriter $out, array $v, int $protocol) : void{
		CommonTypes::writeRecipeNetId($out, $v['recipeId']);
		Byte::writeUnsigned($out, $v['repetitions']);
		Byte::writeUnsigned($out, $v['repetitions2']);
		Byte::writeUnsigned($out, count($v['ingredients']));
		foreach($v['ingredients'] as $ingredient) CommonTypes::putRecipeIngredient($out, $ingredient);
	}
	private static function readDeprecatedResults(ByteBufferReader $in, int $protocol) : array{
		$results = [];
		$len = VarInt::readUnsignedInt($in);
		for($i = 0; $i < $len; $i++) $results[] = CommonTypes::getItemStackWithoutStackId($in);
		return ['results' => $results, 'iterations' => Byte::readUnsigned($in)];
	}
	private static function writeDeprecatedResults(ByteBufferWriter $out, array $v, int $protocol) : void{
		VarInt::writeUnsignedInt($out, count($v['results']));
		foreach($v['results'] as $result) CommonTypes::putItemStackWithoutStackId($out, $result);
		Byte::writeUnsigned($out, $v['iterations']);
	}

	private static function registerPlayerListEntry(TypeRegistry $registry) : void{
		$registry->register(
			'entry',
			reader: static function(ByteBufferReader $in, int $protocol) : array{

				$uuid = CommonTypes::getUUID($in);

				return [
					'uuid' => $uuid,
					'actorUniqueId' => CommonTypes::getActorUniqueId($in),
					'username' => CommonTypes::getString($in),
					'xboxUserId' => CommonTypes::getString($in),
					'platformChatId' => CommonTypes::getString($in),
					'buildPlatform' => LE::readSignedInt($in),
					'skinData' => CommonTypes::getSkin($in),
					'isTeacher' => CommonTypes::getBool($in),
					'isHost' => CommonTypes::getBool($in),
					'isSubClient' => CommonTypes::getBool($in),
					'color' => LE::readUnsignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{

				CommonTypes::putUUID($out, $v['uuid']);
				CommonTypes::putActorUniqueId($out, $v['actorUniqueId']);
				CommonTypes::putString($out, $v['username']);
				CommonTypes::putString($out, $v['xboxUserId']);
				CommonTypes::putString($out, $v['platformChatId']);
				LE::writeSignedInt($out, $v['buildPlatform']);
				CommonTypes::putSkin($out, $v['skinData']);
				CommonTypes::putBool($out, $v['isTeacher']);
				CommonTypes::putBool($out, $v['isHost']);
				CommonTypes::putBool($out, $v['isSubClient']);
				LE::writeUnsignedInt($out, $v['color']);
			}
		);
	}

	private static function registerUpdateAbilitiesPacket(TypeRegistry $registry) : void{
		$registry->register(
			'update_abilities_packet',
			reader: static function(ByteBufferReader $in, int $protocol) : array{
				return [
					'data' => AbilitiesData::decode($in)
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol) : void{
				$v['data']->encode($out);
			}
		);
	}
}