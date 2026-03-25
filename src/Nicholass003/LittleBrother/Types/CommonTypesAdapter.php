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
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\network\mcpe\protocol\types\entity\IntMetadataProperty;

final class CommonTypesAdapter{

	public static function register(TypeRegistry $registry) : void{
		// Scalar
		$registry->register(
			"string",
			fn($in, $protocol, $context) => CommonTypes::getString($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putString($out, $v)
		);
		$registry->register(
			"bool",
			fn($in, $protocol, $context) => CommonTypes::getBool($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putBool($out, $v)
		);

		// Identity
		$registry->register(
			"uuid",
			fn($in, $protocol, $context) => CommonTypes::getUUID($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putUUID($out, $v)
		);

		// Position / geometry
		$registry->register(
			"vector3",
			fn($in, $protocol, $context) => CommonTypes::getVector3($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putVector3($out, $v)
		);
		$registry->register(
			"vector2",
			fn($in, $protocol, $context) => CommonTypes::getVector2($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putVector2($out, $v)
		);
		$registry->register(
			"blockpos",
			function($in, $protocol, $context) {
				if($protocol >= ProtocolVersion::BE_1_26_10){
					return CommonTypes::getSignedBlockPosition($in);
				}
				return CommonTypes::getBlockPosition($in);
			},
			function($out, $v, $protocol, $context) {
				CommonTypes::putBlockPosition($out, $v);
			}
		);
		$registry->register(
			"signed_blockpos",
			fn($in, $protocol, $context) => CommonTypes::getSignedBlockPosition($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putSignedBlockPosition($out, $v)
		);
		$registry->register(
			"blockpos_legacy",
			fn($in, $protocol, $context) => CommonTypes::getBlockPosition($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putBlockPosition($out, $v)
		);

		// ActorRuntimeId
		$registry->register(
			"actor_runtime_id",
			fn($in, $protocol, $context) => CommonTypes::getActorRuntimeId($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putActorRuntimeId($out, $v)
		);

		// ActorUniqueId
		$registry->register(
			"actor_unique_id",
			fn($in, $protocol, $context) => CommonTypes::getActorUniqueId($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putActorUniqueId($out, $v)
		);

		// EntityMetadata
		$registry->register(
			"entity_metadata",
			fn($in, $protocol, $context) => CommonTypes::getEntityMetadata($in),
			function($out, $v, $protocol, $context) {
				if($context->get('actorType') === EntityIds::FALLING_BLOCK){
					$k = EntityMetadataProperties::VARIANT;
					if(isset($v[$k])){
						/** @var IntMetadataProperty $d */
						$d = $v[$k];
						$v[$k] = new IntMetadataProperty($context->getTypeRegistry()->getPlugin()->getRuntimeBlockMapper()->serverToClient($protocol, $d->getValue()));
					}
				}
				CommonTypes::putEntityMetadata($out, $v);
			}
		);

		// Skin
		$registry->register(
			"skin",
			fn($in, $protocol, $context) => CommonTypes::getSkin($in),
			fn($out, $v, $protocol, $context) => CommonTypes::putSkin($out, $v)
		);

		// GameRule
		$registry->register(
			"gamerules",
			fn($in, $protocol, $context) => CommonTypes::getGameRules($in, false),
			fn($out, $v, $protocol, $context) => CommonTypes::putGameRules($out, $v, false)
		);

		// NBT
		$registry->register(
			"nbt",
			fn($in, $protocol, $context) => CommonTypes::getNbtRoot($in),
			fn($out, $v, $protocol, $context) => throw new \RuntimeException(
				"NBT write not implemented. If a packet requires NBT writing, " .
				"register it manually in ManualTypeRegistry as an opaque type."
			)
		);
	}
}