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

use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Schema\PacketContext;
use Nicholass003\LittleBrother\Types\Biome\BiomeChunkGenParser;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\AbilitiesData;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\network\mcpe\protocol\types\command\CommandOriginData;
use pocketmine\network\mcpe\protocol\types\command\CommandPermissions;
use pocketmine\network\mcpe\protocol\types\inventory\stackrequest\ItemStackRequestActionType;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\utils\Binary;
use function array_flip;
use function array_merge;
use function count;
use function ord;
use function str_split;

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

		self::registerRotationByte($registry);
		self::registerEntityLink($registry);
		self::registerAttribute($registry);
		self::registerGameRules($registry);
		self::registerCommandRawData($registry);
		self::registerCommandOriginData($registry);
		self::registerGetCommandMessage($registry);
		self::registerEnumValueIndexes($registry);
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
		self::registerSerializableVoxelShape($registry);
		self::registerCameraSplineInstruction($registry);
		self::registerCameraAimAssistCategoryPriorities($registry);
		self::registerCameraAimAssistPresetExclusionDefinition($registry);
		self::registerCameraAimAssistPresetItemSettings($registry);
		self::registerPlayerListEntry($registry);
		self::registerUpdateAbilitiesPacket($registry);
		self::registerEventDataLevelEvent($registry);
		self::registerLevelSoundExtraData($registry);
	}

	private static function registerCacheableNbt(TypeRegistry $registry) : void{
		$registry->register(
			'cacheable_nbt',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : string{
				return (new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt();
			},
			writer: static function(ByteBufferWriter $out, string $bytes, int $protocol, PacketContext $context) : void{
				$out->writeByteArray($bytes);
			}
		);
	}

	private static function registerRotationByte(TypeRegistry $registry) : void{
		$registry->register(
			'rotation_byte',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : float{
				return CommonTypes::getRotationByte($in);
			},
			writer: static function(ByteBufferWriter $out, float $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putRotationByte($out, $v);
			}
		);
	}

	private static function registerEntityLink(TypeRegistry $registry) : void{
		$registry->register(
			'entity_link',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'fromActorUniqueId' => CommonTypes::getActorUniqueId($in),
					'toActorUniqueId' => CommonTypes::getActorUniqueId($in),
					'type' => Byte::readUnsigned($in),
					'immediate' => CommonTypes::getBool($in),
					'causedByRider' => CommonTypes::getBool($in),
					'vehicleAngularVelocity' => LE::readFloat($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$id = CommonTypes::getString($in);
				$min = LE::readFloat($in);
				$current = LE::readFloat($in);
				$max = LE::readFloat($in);
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
					'id' => $id,
					'modifiers' => $modifiers,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['id']);
				LE::writeFloat($out, $v['min']);
				LE::writeFloat($out, $v['current']);
				LE::writeFloat($out, $v['max']);
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return CommonTypes::getGameRules($in, false);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putGameRules($out, $v, false);
			}
		);
	}

	private static function registerCommandOriginData(TypeRegistry $registry) : void{
		$intToString = [
			0 => CommandOriginData::ORIGIN_PLAYER,
			1 => CommandOriginData::ORIGIN_BLOCK,
			2 => CommandOriginData::ORIGIN_MINECART_BLOCK,
			3 => CommandOriginData::ORIGIN_DEV_CONSOLE,
			4 => CommandOriginData::ORIGIN_TEST,
			5 => CommandOriginData::ORIGIN_AUTOMATION_PLAYER,
			6 => CommandOriginData::ORIGIN_CLIENT_AUTOMATION,
			7 => CommandOriginData::ORIGIN_DEDICATED_SERVER,
			8 => CommandOriginData::ORIGIN_ENTITY,
			9 => CommandOriginData::ORIGIN_VIRTUAL,
			10 => CommandOriginData::ORIGIN_GAME_ARGUMENT,
			11 => CommandOriginData::ORIGIN_ENTITY_SERVER,
		];

		$stringToInt = array_flip($intToString);

		$registry->register(
			'command_origin_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use ($intToString, $stringToInt) : array{
				$params = [];
				if($protocol <= ProtocolVersion::BE_1_21_120){
					$typeInt = VarInt::readUnsignedInt($in);
					$params['type_int'] = $typeInt;
					$params['type_str'] = $intToString[$typeInt] ?? CommandOriginData::ORIGIN_PLAYER;
					$params['uuid'] = CommonTypes::getUUID($in);
					$params['requestId'] = CommonTypes::getString($in);
					if($typeInt === 3 || $typeInt === 4){
						$params['playerActorUniqueId'] = VarInt::readSignedLong($in);
					}else{
						$params['playerActorUniqueId'] = 0;
					}
				}else{
					$typeStr = CommonTypes::getString($in);
					$params['type_str'] = $typeStr;
					$params['type_int'] = $stringToInt[$typeStr] ?? 0;
					$params['uuid'] = CommonTypes::getUUID($in);
					$params['requestId'] = CommonTypes::getString($in);
					$params['playerActorUniqueId'] = LE::readSignedLong($in);
				}
				return $params;
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				if($protocol <= ProtocolVersion::BE_1_21_120){
					$typeInt = $v['type_int'];
					VarInt::writeUnsignedInt($out, $typeInt);
					CommonTypes::putUUID($out, $v['uuid']);
					CommonTypes::putString($out, $v['requestId']);
					if($typeInt === 3 || $typeInt === 4){
						VarInt::writeSignedLong($out, $v['playerActorUniqueId']);
					}
				}else{
					CommonTypes::putString($out, $v['type_str']);
					CommonTypes::putUUID($out, $v['uuid']);
					CommonTypes::putString($out, $v['requestId']);
					LE::writeSignedLong($out, $v['playerActorUniqueId'] ?? 0);
				}
			}
		);
	}

	private static function registerGetCommandMessage(TypeRegistry $registry) : void{
		$registry->register(
			'get_command_message',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				if($protocol <= ProtocolVersion::BE_1_21_120){
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
				}else{
					$messageId = CommonTypes::getString($in);
					$success = CommonTypes::getBool($in);
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
				}
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				if($protocol <= ProtocolVersion::BE_1_21_120){
					CommonTypes::putBool($out, $v['success']);
					CommonTypes::putString($out, $v['messageId']);
					VarInt::writeUnsignedInt($out, count($v['params']));
					foreach($v['params'] as $param){
						CommonTypes::putString($out, $param);
					}
				}else{
					CommonTypes::putString($out, $v['messageId']);
					CommonTypes::putBool($out, $v['success']);
					VarInt::writeUnsignedInt($out, count($v['params']));
					foreach($v['params'] as $param){
						CommonTypes::putString($out, $param);
					}
				}
			}
		);
	}

	private static function registerStructureSettings(TypeRegistry $registry) : void{
		$registry->register(
			'structure_settings',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'paletteName' => CommonTypes::getString($in),
					'ignoreEntities' => CommonTypes::getBool($in),
					'ignoreBlocks' => CommonTypes::getBool($in),
					'allowNonTickingChunks' => CommonTypes::getBool($in),
					'dimensions' => function($in, $protocol, $context){
						if($protocol >= ProtocolVersion::BE_1_26_10){
							return CommonTypes::getSignedBlockPosition($in);
						}
						return CommonTypes::getBlockPosition($in);
					},
					'offset' => function($in, $protocol, $context){
						if($protocol >= ProtocolVersion::BE_1_26_10){
							return CommonTypes::getSignedBlockPosition($in);
						}
						return CommonTypes::getBlockPosition($in);
					},
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['paletteName']);
				CommonTypes::putBool($out, $v['ignoreEntities']);
				CommonTypes::putBool($out, $v['ignoreBlocks']);
				CommonTypes::putBool($out, $v['allowNonTickingChunks']);
				if($protocol >= ProtocolVersion::BE_1_26_10){
					CommonTypes::putSignedBlockPosition($out, $v['dimensions']);
				}else{
					CommonTypes::putBlockPosition($out, $v['dimensions']);
				}
				if($protocol >= ProtocolVersion::BE_1_26_10){
					CommonTypes::putSignedBlockPosition($out, $v['offset']);
				}else{
					CommonTypes::putBlockPosition($out, $v['offset']);
				}
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'structureName' => CommonTypes::getString($in),
					'filteredStructureName' => CommonTypes::getString($in),
					'structureDataField' => CommonTypes::getString($in),
					'includePlayers' => CommonTypes::getBool($in),
					'showBoundingBox' => CommonTypes::getBool($in),
					'structureBlockType' => VarInt::readSignedInt($in),
					'structureSettings' => self::readStructureSettingsInline($in, $protocol),
					'structureRedstoneSaveMode' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['structureName']);
				CommonTypes::putString($out, $v['filteredStructureName']);
				CommonTypes::putString($out, $v['structureDataField']);
				CommonTypes::putBool($out, $v['includePlayers']);
				CommonTypes::putBool($out, $v['showBoundingBox']);
				VarInt::writeSignedInt($out, $v['structureBlockType']);
				self::writeStructureSettingsInline($out, $v['structureSettings'], $protocol);
				VarInt::writeSignedInt($out, $v['structureRedstoneSaveMode']);
			}
		);
	}

	private static function readStructureSettingsInline(ByteBufferReader $in, int $protocol) : array{
		return [
			'paletteName' => CommonTypes::getString($in),
			'ignoreEntities' => CommonTypes::getBool($in),
			'ignoreBlocks' => CommonTypes::getBool($in),
			'allowNonTickingChunks' => CommonTypes::getBool($in),
			'dimensions' => function($in, $protocol, $context){
						if($protocol >= ProtocolVersion::BE_1_26_10){
							return CommonTypes::getSignedBlockPosition($in);
						}
						return CommonTypes::getBlockPosition($in);
					},
			'offset' => function($in, $protocol, $context){
						if($protocol >= ProtocolVersion::BE_1_26_10){
							return CommonTypes::getSignedBlockPosition($in);
						}
						return CommonTypes::getBlockPosition($in);
					},
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

	private static function writeStructureSettingsInline(ByteBufferWriter $out, array $v, int $protocol) : void{
		CommonTypes::putString($out, $v['paletteName']);
		CommonTypes::putBool($out, $v['ignoreEntities']);
		CommonTypes::putBool($out, $v['ignoreBlocks']);
		CommonTypes::putBool($out, $v['allowNonTickingChunks']);
		if($protocol >= ProtocolVersion::BE_1_26_10){
			CommonTypes::putSignedBlockPosition($out, $v['dimensions']);
		}else{
			CommonTypes::putBlockPosition($out, $v['dimensions']);
		}
		if($protocol >= ProtocolVersion::BE_1_26_10){
			CommonTypes::putSignedBlockPosition($out, $v['offset']);
		}else{
			CommonTypes::putBlockPosition($out, $v['offset']);
		}
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'maxHeight' => VarInt::readSignedInt($in),
					'minHeight' => VarInt::readSignedInt($in),
					'generator' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				VarInt::writeSignedInt($out, $v['maxHeight']);
				VarInt::writeSignedInt($out, $v['minHeight']);
				VarInt::writeSignedInt($out, $v['generator']);
			}
		);
	}

	private static function registerChunkCacheBlob(TypeRegistry $registry) : void{
		$registry->register(
			'chunk_cache_blob',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$hash = LE::readUnsignedLong($in);
				$payload = CommonTypes::getString($in);
				return ['hash' => $hash, 'payload' => $payload];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				LE::writeUnsignedLong($out, $v['hash']);
				CommonTypes::putString($out, $v['payload']);
			}
		);
	}

	private static function registerMapDecoration(TypeRegistry $registry) : void{
		$registry->register(
			'map_decoration',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : string{
				return $in->readByteArray($in->getUnreadLength());
			},
			writer: static function(ByteBufferWriter $out, string $v, int $protocol, PacketContext $context) : void{
				$out->writeByteArray($v);
			}
		);
	}

	private static function registerItemStack(TypeRegistry $registry) : void{
		$registry->register(
			'item_stack',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : mixed{
				return CommonTypes::getItemStackWithoutStackId($in);
			},
			writer: static function(ByteBufferWriter $out, mixed $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putItemStackWithoutStackId($out, $v);
			}
		);
	}

	private static function registerRecipeIngredient(TypeRegistry $registry) : void{
		$registry->register(
			'recipe_ingredient',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : mixed{
				return CommonTypes::getRecipeIngredient($in);
			},
			writer: static function(ByteBufferWriter $out, mixed $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putRecipeIngredient($out, $v);
			}
		);
	}

	private static function registerRecipeUnlockingRequirement(TypeRegistry $registry) : void{
		$registry->register(
			'recipe_unlocking_requirement',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'inputItemId' => VarInt::readSignedInt($in),
					'inputItemMeta' => VarInt::readSignedInt($in),
					'ingredientItemId' => VarInt::readSignedInt($in),
					'ingredientItemMeta' => VarInt::readSignedInt($in),
					'outputItemId' => VarInt::readSignedInt($in),
					'outputItemMeta' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'inputItemId' => VarInt::readSignedInt($in),
					'ingredientItemId' => VarInt::readSignedInt($in),
					'outputItemId' => VarInt::readSignedInt($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				VarInt::writeSignedInt($out, $v['inputItemId']);
				VarInt::writeSignedInt($out, $v['ingredientItemId']);
				VarInt::writeSignedInt($out, $v['outputItemId']);
			}
		);
	}

	private static function registerMaterialReducerRecipe(TypeRegistry $registry) : void{
		$registry->register(
			'material_reducer_recipe',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return self::readNetworkInventoryActions($in, $protocol, $context);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol, $context);
			}
		);

		$registry->register(
			'mismatch_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return self::readNetworkInventoryActions($in, $protocol, $context);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol, $context);
			}
		);

		$registry->register(
			'use_item_transaction_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$base = self::readNetworkInventoryActions($in, $protocol, $context);
				return array_merge($base, [
					'actionType' => VarInt::readUnsignedInt($in),
					'triggerType' => VarInt::readUnsignedInt($in),
					'blockPosition' => function($in, $protocol, $context){
						if($protocol >= ProtocolVersion::BE_1_26_10){
							return CommonTypes::getSignedBlockPosition($in);
						}
						return CommonTypes::getBlockPosition($in);
					},
					'face' => VarInt::readSignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'playerPosition' => CommonTypes::getVector3($in),
					'clickPosition' => CommonTypes::getVector3($in),
					'blockRuntimeId' => VarInt::readUnsignedInt($in),
					'clientInteractPrediction' => VarInt::readUnsignedInt($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol, $context);
				VarInt::writeUnsignedInt($out, $v['actionType']);
				VarInt::writeUnsignedInt($out, $v['triggerType']);
				if($protocol >= ProtocolVersion::BE_1_26_10){
					CommonTypes::putSignedBlockPosition($out, $v['blockPosition']);
				}else{
					CommonTypes::putBlockPosition($out, $v['blockPosition']);
				}
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$base = self::readNetworkInventoryActions($in, $protocol, $context);
				return array_merge($base, [
					'actorRuntimeId' => CommonTypes::getActorRuntimeId($in),
					'actionType' => VarInt::readUnsignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'playerPosition' => CommonTypes::getVector3($in),
					'clickPosition' => CommonTypes::getVector3($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol, $context);
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$base = self::readNetworkInventoryActions($in, $protocol, $context);
				return array_merge($base, [
					'actionType' => VarInt::readUnsignedInt($in),
					'hotbarSlot' => VarInt::readSignedInt($in),
					'itemInHand' => CommonTypes::getItemStackWrapper($in),
					'headPosition' => CommonTypes::getVector3($in),
				]);
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				self::writeNetworkInventoryActions($out, $v['actions'], $protocol, $context);
				VarInt::writeUnsignedInt($out, $v['actionType']);
				VarInt::writeSignedInt($out, $v['hotbarSlot']);
				CommonTypes::putItemStackWrapper($out, $v['itemInHand']);
				CommonTypes::putVector3($out, $v['headPosition']);
			}
		);
	}

	private static function readNetworkInventoryActions(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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

	private static function writeNetworkInventoryActions(ByteBufferWriter $out, array $actions, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::FLOAT = 0
				$value = LE::readFloat($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				LE::writeFloat($out, $v['value']);
			}
		);

		$registry->register(
			'bool_pack_setting',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::BOOL = 1
				$value = CommonTypes::getBool($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				CommonTypes::putBool($out, $v['value']);
			}
		);

		$registry->register(
			'string_pack_setting',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$name = CommonTypes::getString($in);
				$typeId = VarInt::readUnsignedInt($in); // PackSettingType::STRING = 2
				$value = CommonTypes::getString($in);
				return ['name' => $name, 'typeId' => $typeId, 'value' => $value];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['name']);
				VarInt::writeUnsignedInt($out, $v['typeId']);
				CommonTypes::putString($out, $v['value']);
			}
		);
	}

	private static function registerSerializableVoxelCells(TypeRegistry $registry) : void{
		$registry->register(
			'serializable_voxel_cells',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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

	private static function registerSerializableVoxelShape(TypeRegistry $registry) : void{
		$registry->register(
			'serializable_voxel_shape',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use($registry) : array{
				if($protocol >= ProtocolVersion::BE_1_26_10){
					$cells = $registry->read($in, 'serializable_voxel_cells', $protocol, $context);
				}else{
					$xSize = Byte::readUnsigned($in);
					$ySize = Byte::readUnsigned($in);
					$zSize = Byte::readUnsigned($in);
					$storage = [];
					$count = VarInt::readUnsignedInt($in);
					for($i = 0; $i < $count; $i++){
						$storage[] = Byte::readUnsigned($in);
					}
					$cells = [
						'xSize' => $xSize,
						'ySize' => $ySize,
						'zSize' => $zSize,
						'storage' => $storage,
					];
				}

				$xCoordinates = [];
				$xCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $xCount; $i++){
					$xCoordinates[] = LE::readFloat($in);
				}

				$yCoordinates = [];
				$yCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $yCount; $i++){
					$yCoordinates[] = LE::readFloat($in);
				}

				$zCoordinates = [];
				$zCount = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $zCount; $i++){
					$zCoordinates[] = LE::readFloat($in);
				}

				return [
					'cells' => $cells,
					'xCoordinates' => $xCoordinates,
					'yCoordinates' => $yCoordinates,
					'zCoordinates' => $zCoordinates,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) use($registry) : void{
				if($protocol >= ProtocolVersion::BE_1_26_10){
					$registry->write($out, 'serializable_voxel_cells', $v['cells'], $protocol, $context);
				}else{
					$cells = $v['cells'];
					Byte::writeUnsigned($out, $cells['xSize']);
					Byte::writeUnsigned($out, $cells['ySize']);
					Byte::writeUnsigned($out, $cells['zSize']);
					VarInt::writeUnsignedInt($out, count($cells['storage']));
					foreach($cells['storage'] as $byte){
						Byte::writeUnsigned($out, $byte);
					}
				}

				VarInt::writeUnsignedInt($out, count($v['xCoordinates']));
				foreach($v['xCoordinates'] as $f){
					LE::writeFloat($out, $f);
				}

				VarInt::writeUnsignedInt($out, count($v['yCoordinates']));
				foreach($v['yCoordinates'] as $f){
					LE::writeFloat($out, $f);
				}

				VarInt::writeUnsignedInt($out, count($v['zCoordinates']));
				foreach($v['zCoordinates'] as $f){
					LE::writeFloat($out, $f);
				}
			}
		);
	}

	private static function registerCameraSplineInstruction(TypeRegistry $registry) : void{
		$registry->register(
			'camera_spline_instruction',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'itemIdentifier' => CommonTypes::getString($in),
					'categoryName' => CommonTypes::getString($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['itemIdentifier']);
				CommonTypes::putString($out, $v['categoryName']);
			}
		);
	}

	private static function registerOptionalServerJoinInformation(TypeRegistry $registry) : void{
		$registry->register(
			'server_join_information',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : string{
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
			writer: static function(ByteBufferWriter $out, string $rawBytes, int $protocol, PacketContext $context) : void{
				foreach(str_split($rawBytes) as $byte){
					Byte::writeUnsigned($out, ord($byte));
				}
			}
		);
	}

	private static function registerAbilitiesLayer(TypeRegistry $registry) : void{
		$registry->register(
			'abilities_layer',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'layerId' => LE::readUnsignedShort($in),
					'setAbilities' => LE::readUnsignedInt($in),
					'setAbilitiesValue' => LE::readUnsignedInt($in),
					'flySpeed' => LE::readFloat($in),
					'verticalFlySpeed' => LE::readFloat($in),
					'walkSpeed' => LE::readFloat($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$requestId = CommonTypes::readItemStackRequestId($in);
				$actions = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$typeId = Byte::readUnsigned($in);
					$actions[] = ['typeId' => $typeId, 'payload' => self::readActionPayload($in, $typeId, $protocol, $context)];
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::writeItemStackRequestId($out, $v['requestId']);
				VarInt::writeUnsignedInt($out, count($v['actions']));
				foreach($v['actions'] as $action){
					Byte::writeUnsigned($out, $action['typeId']);
					self::writeActionPayload($out, $action['typeId'], $action['payload'], $protocol, $context);
				}
				VarInt::writeUnsignedInt($out, count($v['filterStrings']));
				foreach($v['filterStrings'] as $s) CommonTypes::putString($out, $s);
				LE::writeSignedInt($out, $v['filterCause']);
			},
		);
	}

	private static function registerAttributeModifier(TypeRegistry $registry) : void{
		$registry->register(
			'attribute_modifier',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'id' => CommonTypes::getString($in),
					'name' => CommonTypes::getString($in),
					'amount' => LE::readFloat($in),
					'operation' => LE::readSignedInt($in),
					'operand' => LE::readSignedInt($in),
					'serializable' => CommonTypes::getBool($in),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$params = [];
				if($protocol <= ProtocolVersion::BE_1_21_120){
					$params['nameIndex'] = LE::readUnsignedShort($in);
					$params['type'] = LE::readUnsignedShort($in);
				}else{
					$params['nameIndex'] = VarInt::readUnsignedInt($in);
					$params['type'] = VarInt::readUnsignedInt($in);
				}
				return $params;
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				if($protocol <= ProtocolVersion::BE_1_21_120){
					LE::writeUnsignedShort($out, $v['nameIndex']);
					LE::writeUnsignedShort($out, $v['type']);
				}else{
					VarInt::writeUnsignedInt($out, $v['nameIndex']);
					VarInt::writeUnsignedInt($out, $v['type']);
				}
			}
		);
	}

	private static function registerItemTypeEntry(TypeRegistry $registry) : void{
		$registry->register(
			'item_type_entry',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'stringId' => CommonTypes::getString($in),
					'numericId' => LE::readSignedShort($in),
					'isComponentBased' => CommonTypes::getBool($in),
					'version' => VarInt::readSignedInt($in),
					'nbt' => (new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt(),
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : int{
				return Byte::readUnsigned($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol, PacketContext $context) : void{
				Byte::writeUnsigned($out, $v);
			}
		);
	}

	private static function registerCommandRawData(TypeRegistry $registry) : void{
		$registry->register(
			'command_raw_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$name = CommonTypes::getString($in);
				$description = CommonTypes::getString($in);
				$flags = LE::readUnsignedShort($in);

				if($protocol >= ProtocolVersion::BE_1_21_130){
					$permission = CommonTypes::getString($in);
				}else{
					$permissionInt = Byte::readUnsigned($in);
					$permission = CommandPermissions::toName($permissionInt);
				}

				$aliasEnumIndex = LE::readSignedInt($in);
				$chainedIndices = [];
				$chainedCount = VarInt::readUnsignedInt($in);

				for($i = 0; $i < $chainedCount; $i++){
					if($protocol >= ProtocolVersion::BE_1_21_130){
						$chainedIndices[] = LE::readUnsignedInt($in);
					}else{
						$chainedIndices[] = LE::readUnsignedShort($in);
					}
				}

				$overloads = [];
				$overloadCount = VarInt::readUnsignedInt($in);

				for($i = 0; $i < $overloadCount; $i++){
					$overloads[] = $context->getTypeRegistry()->read($in, 'command_overload_raw_data', $protocol, $context);
				}

				return [
					'name' => $name,
					'description' => $description,
					'flags' => $flags,
					'permission' => $permission,
					'aliasEnumIndex' => $aliasEnumIndex,
					'chainedSubCommandDataIndexes' => $chainedIndices,
					'overloads' => $overloads,
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v['name']);
				CommonTypes::putString($out, $v['description']);
				LE::writeUnsignedShort($out, $v['flags']);

				if($protocol >= ProtocolVersion::BE_1_21_130){
					CommonTypes::putString($out, $v['permission']);
				}else{
					$permissionInt = CommandPermissions::fromName($v['permission']);
					Byte::writeUnsigned($out, $permissionInt);
				}

				LE::writeSignedInt($out, $v['aliasEnumIndex']);

				VarInt::writeUnsignedInt($out, count($v['chainedSubCommandDataIndexes']));
				foreach($v['chainedSubCommandDataIndexes'] as $index){
					if($protocol >= ProtocolVersion::BE_1_21_130){
						LE::writeUnsignedInt($out, $index);
					}else{
						LE::writeUnsignedShort($out, $index);
					}
				}

				VarInt::writeUnsignedInt($out, count($v['overloads']));
				foreach($v['overloads'] as $overload){
					$context->getTypeRegistry()->write($out, 'command_overload_raw_data', $overload, $protocol, $context);
				}
			}
		);
	}

	private static function registerCommandOverload(TypeRegistry $registry) : void{
		$registry->register(
			'command_overload_raw_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : int{
				return LE::readUnsignedInt($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol, PacketContext $context) : void{
				LE::writeUnsignedInt($out, $v);
			}
		);
	}

	private static function registerChangedSlot(TypeRegistry $registry) : void{
		$registry->register(
			'changed_slot',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : int{
				return Byte::readUnsigned($in);
			},
			writer: static function(ByteBufferWriter $out, int $v, int $protocol, PacketContext $context) : void{
				Byte::writeUnsigned($out, $v);
			}
		);
	}

	private static function registerCommandSoftEnumValue(TypeRegistry $registry) : void{
		$registry->register(
			'command_soft_enum_value',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : string{
				return CommonTypes::getString($in);
			},
			writer: static function(ByteBufferWriter $out, string $v, int $protocol, PacketContext $context) : void{
				CommonTypes::putString($out, $v);
			}
		);
	}

	private static function registerEnumValueIndexes(TypeRegistry $registry) : void{
		$registry->register(
			'enums_value_indexes',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				$size = VarInt::readUnsignedInt($in);
				$params = [];
				if($protocol <= ProtocolVersion::BE_1_21_120){
					$enumValuesCount = $context->get('enumValuesCount');
					for($i = 0; $i < $size; $i++){
						$params[] = [
							'valueIndexes' => match(true){
								$enumValuesCount < 256 => Byte::readUnsigned($in),
								$enumValuesCount < 65536 => LE::readUnsignedShort($in),
								default => LE::readUnsignedInt($in)
							}
						];
					}
				}else{
					for($i = 0; $i < $size; $i++){
						$params[] = [
							'valueIndexes' => LE::readUnsignedInt($in)
						];
					}
				}
				return ['size' => $size, 'params' => $params];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				VarInt::writeUnsignedInt($out, $v['size']);
				$enumValuesCount = $context->get('enumValuesCount');
				if($protocol <= ProtocolVersion::BE_1_21_120){
					foreach($v['params'] as $p){
						match(true){
							$enumValuesCount < 256 => Byte::writeUnsigned($out, $p['valueIndexes']),
							$enumValuesCount < 65536 => LE::writeUnsignedShort($out, $p['valueIndexes']),
							default => LE::writeUnsignedInt($out, $p['valueIndexes'])
						};
					}
				}else{
					foreach($v['params'] as $p){
						LE::writeUnsignedInt($out, $p['valueIndexes']);
					}
				}
			}
		);
	}

	private static function registerOptionalBiomeDefinitionTags(TypeRegistry $registry) : void{
		$registry->register(
			'biome_definition_tags',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : ?array{
				$hasValue = Byte::readUnsigned($in) !== 0;
				if(!$hasValue) return null;
				$tags = [];
				$count = VarInt::readUnsignedInt($in);
				for($i = 0; $i < $count; $i++){
					$tags[] = LE::readUnsignedShort($in);
				}
				return $tags;
			},
			writer: static function(ByteBufferWriter $out, ?array $tags, int $protocol, PacketContext $context) : void{
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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : ?array{
				return BiomeChunkGenParser::read($in, $protocol, $context);
			},
			writer: static function(ByteBufferWriter $out, ?array $value, int $protocol, PacketContext $context) : void{
				BiomeChunkGenParser::write($out, $value, $protocol, $context);
			}
		);
	}

	private const ACTION_TAKE = ItemStackRequestActionType::TAKE; // 0
	private const ACTION_PLACE = ItemStackRequestActionType::PLACE; // 1
	private const ACTION_SWAP = ItemStackRequestActionType::SWAP; // 2
	private const ACTION_DROP = ItemStackRequestActionType::DROP; // 3
	private const ACTION_DESTROY = ItemStackRequestActionType::DESTROY; // 4
	private const ACTION_CRAFTING_CONSUME_INPUT = ItemStackRequestActionType::CRAFTING_CONSUME_INPUT; // 5
	private const ACTION_CRAFTING_CREATE_SPECIFIC = ItemStackRequestActionType::CRAFTING_CREATE_SPECIFIC_RESULT; // 6
	private const ACTION_LAB_TABLE_COMBINE = ItemStackRequestActionType::LAB_TABLE_COMBINE; // 9
	private const ACTION_BEACON_PAYMENT = ItemStackRequestActionType::BEACON_PAYMENT; // 10
	private const ACTION_MINE_BLOCK = ItemStackRequestActionType::MINE_BLOCK; // 11
	private const ACTION_CRAFTING_RECIPE = ItemStackRequestActionType::CRAFTING_RECIPE; // 12
	private const ACTION_CRAFTING_RECIPE_AUTO = ItemStackRequestActionType::CRAFTING_RECIPE_AUTO; // 13
	private const ACTION_CREATIVE_CREATE = ItemStackRequestActionType::CREATIVE_CREATE; // 14
	private const ACTION_CRAFTING_RECIPE_OPTIONAL = ItemStackRequestActionType::CRAFTING_RECIPE_OPTIONAL; // 15
	private const ACTION_CRAFTING_GRINDSTONE = ItemStackRequestActionType::CRAFTING_GRINDSTONE; // 16
	private const ACTION_CRAFTING_LOOM = ItemStackRequestActionType::CRAFTING_LOOM; // 17
	private const ACTION_CRAFTING_NON_IMPLEMENTED = ItemStackRequestActionType::CRAFTING_NON_IMPLEMENTED_DEPRECATED_ASK_TY_LAING; // 18
	private const ACTION_CRAFTING_RESULTS_DEPRECATED = ItemStackRequestActionType::CRAFTING_RESULTS_DEPRECATED_ASK_TY_LAING; // 19

	private static function readActionPayload(ByteBufferReader $in, int $typeId, int $protocol, PacketContext $context) : array{
		return match($typeId){
			self::ACTION_TAKE,
			self::ACTION_PLACE => self::readSlotTransfer($in, $protocol, $context),
			self::ACTION_SWAP => self::readSlotSwap($in, $protocol, $context),
			self::ACTION_DROP => self::readDrop($in, $protocol, $context),
			self::ACTION_DESTROY,
			self::ACTION_CRAFTING_CONSUME_INPUT => self::readSingleSlot($in, $protocol, $context),
			self::ACTION_CRAFTING_CREATE_SPECIFIC => ['resultIndex' => Byte::readUnsigned($in)],
			self::ACTION_LAB_TABLE_COMBINE => [],
			self::ACTION_BEACON_PAYMENT => ['primaryEffect' => VarInt::readSignedInt($in), 'secondaryEffect' => VarInt::readSignedInt($in)],
			self::ACTION_MINE_BLOCK => ['hotbarSlot' => VarInt::readSignedInt($in), 'predictedDurability' => VarInt::readSignedInt($in), 'stackId' => CommonTypes::readItemStackNetIdVariant($in)],
			self::ACTION_CRAFTING_RECIPE => ['recipeId' => CommonTypes::readRecipeNetId($in), 'repetitions' => Byte::readUnsigned($in)],
			self::ACTION_CRAFTING_RECIPE_AUTO => self::readCraftRecipeAuto($in, $protocol, $context),
			self::ACTION_CREATIVE_CREATE => ['creativeItemId' => CommonTypes::readCreativeItemNetId($in), 'repetitions' => Byte::readUnsigned($in)],
			self::ACTION_CRAFTING_RECIPE_OPTIONAL => ['recipeId' => CommonTypes::readRecipeNetId($in), 'filterStringIndex' => LE::readSignedInt($in)],
			self::ACTION_CRAFTING_GRINDSTONE => ['recipeId' => CommonTypes::readRecipeNetId($in), 'repairCost' => VarInt::readSignedInt($in), 'repetitions' => Byte::readUnsigned($in)],
			self::ACTION_CRAFTING_LOOM => ['patternId' => CommonTypes::getString($in), 'repetitions' => Byte::readUnsigned($in)],
			self::ACTION_CRAFTING_NON_IMPLEMENTED => [],
			self::ACTION_CRAFTING_RESULTS_DEPRECATED => self::readDeprecatedResults($in, $protocol, $context),
			default => throw new \RuntimeException("Unknown ItemStackRequestAction typeId=$typeId"),
		};
	}

	private static function writeActionPayload(ByteBufferWriter $out, int $typeId, array $payload, int $protocol, PacketContext $context) : void{
		match($typeId){
			self::ACTION_TAKE,
			self::ACTION_PLACE => self::writeSlotTransfer($out, $payload, $protocol, $context),
			self::ACTION_SWAP => self::writeSlotSwap($out, $payload, $protocol, $context),
			self::ACTION_DROP => self::writeDrop($out, $payload, $protocol, $context),
			self::ACTION_DESTROY,
			self::ACTION_CRAFTING_CONSUME_INPUT => self::writeSingleSlot($out, $payload, $protocol, $context),
			self::ACTION_CRAFTING_CREATE_SPECIFIC => (static function() use($out, $payload) : void{
								Byte::writeUnsigned($out, $payload['resultIndex']);
							})(),
			self::ACTION_LAB_TABLE_COMBINE => (static function() : void{
								// no payload
							})(),
			self::ACTION_BEACON_PAYMENT => (static function() use($out, $payload) : void{
								VarInt::writeSignedInt($out, $payload['primaryEffect']);
								VarInt::writeSignedInt($out, $payload['secondaryEffect']);
							})(),
			self::ACTION_MINE_BLOCK => (static function() use($out, $payload) : void{
								VarInt::writeSignedInt($out, $payload['hotbarSlot']);
								VarInt::writeSignedInt($out, $payload['predictedDurability']);
								CommonTypes::writeItemStackNetIdVariant($out, $payload['stackId']);
							})(),
			self::ACTION_CRAFTING_RECIPE => (static function() use($out, $payload) : void{
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			self::ACTION_CRAFTING_RECIPE_AUTO => self::writeCraftRecipeAuto($out, $payload, $protocol, $context),
			self::ACTION_CREATIVE_CREATE => (static function() use($out, $payload) : void{
								CommonTypes::writeCreativeItemNetId($out, $payload['creativeItemId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			self::ACTION_CRAFTING_RECIPE_OPTIONAL => (static function() use($out, $payload) : void{
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								LE::writeSignedInt($out, $payload['filterStringIndex']);
							})(),
			self::ACTION_CRAFTING_GRINDSTONE => (static function() use($out, $payload) : void{
								CommonTypes::writeRecipeNetId($out, $payload['recipeId']);
								VarInt::writeSignedInt($out, $payload['repairCost']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			self::ACTION_CRAFTING_LOOM => (static function() use($out, $payload) : void{
								CommonTypes::putString($out, $payload['patternId']);
								Byte::writeUnsigned($out, $payload['repetitions']);
							})(),
			self::ACTION_CRAFTING_NON_IMPLEMENTED => (static function() : void{
								// no payload
							})(),
			self::ACTION_CRAFTING_RESULTS_DEPRECATED => self::writeDeprecatedResults($out, $payload, $protocol, $context),
			default => throw new \RuntimeException("Unknown ItemStackRequestAction typeId=$typeId"),
		};
	}

	private static function readSlotInfo(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		$params = [];
		$params['containerId'] = Byte::readUnsigned($in);
		$params['dynamicContainerId'] = CommonTypes::readOptional($in, LE::readUnsignedInt(...));
		$params['slotId'] = Byte::readUnsigned($in);
		$params['stackId'] = CommonTypes::readItemStackNetIdVariant($in);
		return $params;
	}

	private static function writeSlotInfo(ByteBufferWriter $out, array $slot, int $protocol, PacketContext $context) : void{
		Byte::writeUnsigned($out, $slot['containerId']);
		CommonTypes::writeOptional($out, $slot['dynamicContainerId'] ?? null, LE::writeUnsignedInt(...));
		Byte::writeUnsigned($out, $slot['slotId']);
		CommonTypes::writeItemStackNetIdVariant($out, $slot['stackId']);
	}

	private static function readSlotTransfer(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol, $context), 'dst' => self::readSlotInfo($in, $protocol, $context)];
	}

	private static function writeSlotTransfer(ByteBufferWriter $out, array $v, int $protocol, $context) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol, $context); self::writeSlotInfo($out, $v['dst'], $protocol, $context);
	}

	private static function readSlotSwap(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		return ['src' => self::readSlotInfo($in, $protocol, $context), 'dst' => self::readSlotInfo($in, $protocol, $context)];
	}

	private static function writeSlotSwap(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
		self::writeSlotInfo($out, $v['src'], $protocol, $context); self::writeSlotInfo($out, $v['dst'], $protocol, $context);
	}

	private static function readDrop(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol, $context), 'randomDrop' => Byte::readUnsigned($in) !== 0];
	}

	private static function writeDrop(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol, $context); Byte::writeUnsigned($out, $v['randomDrop'] ? 1 : 0);
	}

	private static function readSingleSlot(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		return ['count' => Byte::readUnsigned($in), 'src' => self::readSlotInfo($in, $protocol, $context)];
	}

	private static function writeSingleSlot(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
		Byte::writeUnsigned($out, $v['count']); self::writeSlotInfo($out, $v['src'], $protocol, $context);
	}

	private static function readCraftRecipeAuto(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		$recipeId = CommonTypes::readRecipeNetId($in);
		$rep1 = Byte::readUnsigned($in);
		$rep2 = Byte::readUnsigned($in);
		$ingredients = [];
		$count = Byte::readUnsigned($in);
		for($i = 0; $i < $count; $i++) $ingredients[] = CommonTypes::getRecipeIngredient($in);
		return ['recipeId' => $recipeId, 'repetitions' => $rep1, 'repetitions2' => $rep2, 'ingredients' => $ingredients];
	}

	private static function writeCraftRecipeAuto(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
		CommonTypes::writeRecipeNetId($out, $v['recipeId']);
		Byte::writeUnsigned($out, $v['repetitions']);
		Byte::writeUnsigned($out, $v['repetitions2']);
		Byte::writeUnsigned($out, count($v['ingredients']));
		foreach($v['ingredients'] as $ingredient) CommonTypes::putRecipeIngredient($out, $ingredient);
	}

	private static function readDeprecatedResults(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
		$results = [];
		$len = VarInt::readUnsignedInt($in);
		for($i = 0; $i < $len; $i++) $results[] = CommonTypes::getItemStackWithoutStackId($in);
		return ['results' => $results, 'iterations' => Byte::readUnsigned($in)];
	}

	private static function writeDeprecatedResults(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
		VarInt::writeUnsignedInt($out, count($v['results']));
		foreach($v['results'] as $result) CommonTypes::putItemStackWithoutStackId($out, $result);
		Byte::writeUnsigned($out, $v['iterations']);
	}

	private static function registerPlayerListEntry(TypeRegistry $registry) : void{
		$registry->register(
			'entry',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{

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
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{

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
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) : array{
				return [
					'data' => AbilitiesData::decode($in)
				];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) : void{
				$v['data']->encode($out);
			}
		);
	}

	private static function registerEventDataLevelEvent(TypeRegistry $registry) : void{
		$registry->register(
			'event_data_level_event',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use($registry) : array{
				$eventData = VarInt::readSignedInt($in);
				return ['eventData' => $eventData];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) use($registry) : void{
				$eventId = $context->get('eventId');
				$eventData = $v['eventData'];

				if($eventId === LevelEvent::PARTICLE_DESTROY || $eventId === LevelEvent::PARTICLE_PUNCH_BLOCK){
					$blockMapper = $registry->getPlugin()->getRuntimeBlockMapper();
					$mapped = $blockMapper->serverToClient($protocol, $eventData);
					$eventData = $mapped;
				}
				VarInt::writeSignedInt($out, $eventData);
			}
		);
	}

	private static function registerLevelSoundExtraData(TypeRegistry $registry) : void{
		$registry->register(
			'level_sound_extra_data',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use($registry) : array{
				$extraData = VarInt::readSignedInt($in);
				return ['extraData' => $extraData];
			},
			writer: static function(ByteBufferWriter $out, array $v, int $protocol, PacketContext $context) use($registry) : void{
				$soundId = $context->get('soundId');
				$extraData = $v['extraData'];

				if($soundId === LevelSoundEvent::PLACE || $soundId === LevelSoundEvent::ITEM_USE_ON){
					$blockMapper = $registry->getPlugin()->getRuntimeBlockMapper();
					$mapped = $blockMapper->serverToClient($protocol, $extraData);
					$extraData = $mapped;
				}
				VarInt::writeSignedInt($out, $extraData);
			}
		);
	}
}