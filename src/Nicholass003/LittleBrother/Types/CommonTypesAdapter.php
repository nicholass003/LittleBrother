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

use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

final class CommonTypesAdapter{

	public static function register(TypeRegistry $registry) : void{
		// Scalar
		$registry->register(
			"string",
			fn($in, $protocol) => CommonTypes::getString($in),
			fn($out, $v, $protocol) => CommonTypes::putString($out, $v)
		);
		$registry->register(
			"bool",
			fn($in, $protocol) => CommonTypes::getBool($in),
			fn($out, $v, $protocol) => CommonTypes::putBool($out, $v)
		);

		// Identity
		$registry->register(
			"uuid",
			fn($in, $protocol) => CommonTypes::getUUID($in),
			fn($out, $v, $protocol) => CommonTypes::putUUID($out, $v)
		);

		// Position / geometry
		$registry->register(
			"vector3",
			fn($in, $protocol) => CommonTypes::getVector3($in),
			fn($out, $v, $protocol) => CommonTypes::putVector3($out, $v)
		);
		$registry->register(
			"vector2",
			fn($in, $protocol) => CommonTypes::getVector2($in),
			fn($out, $v, $protocol) => CommonTypes::putVector2($out, $v)
		);
		$registry->register(
			"blockpos",
			fn($in, $protocol) => CommonTypes::getBlockPosition($in),
			fn($out, $v, $protocol) => CommonTypes::putBlockPosition($out, $v)
		);
		$registry->register(
			"signed_blockpos",
			fn($in, $protocol) => CommonTypes::getSignedBlockPosition($in),
			fn($out, $v, $protocol) => CommonTypes::putSignedBlockPosition($out, $v)
		);

		// ActorRuntimeId
		$registry->register(
			"actor_runtime_id",
			fn($in, $protocol) => CommonTypes::getActorRuntimeId($in),
			fn($out, $v, $protocol) => CommonTypes::putActorRuntimeId($out, $v)
		);

		// ActorUniqueId
		$registry->register(
			"actor_unique_id",
			fn($in, $protocol) => CommonTypes::getActorUniqueId($in),
			fn($out, $v, $protocol) => CommonTypes::putActorUniqueId($out, $v)
		);

		// EntityMetadata
		$registry->register(
			"entity_metadata",
			fn($in, $protocol) => CommonTypes::getEntityMetadata($in),
			fn($out, $v, $protocol) => CommonTypes::putEntityMetadata($out, $v)
		);

		// Skin
		$registry->register(
			"skin",
			fn($in, $protocol) => CommonTypes::getSkin($in),
			fn($out, $v, $protocol) => CommonTypes::putSkin($out, $v)
		);

		// GameRule
		$registry->register(
			"gamerules",
			fn($in, $protocol) => CommonTypes::getGameRules($in, false),
			fn($out, $v, $protocol) => CommonTypes::putGameRules($out, $v, false)
		);

		// ItemStackWrapper
		$registry->register(
			"item_stack_wrapper",
			fn($in, $protocol) => CommonTypes::getItemStackWrapper($in),
			fn($out, $v, $protocol) => CommonTypes::putItemStackWrapper($out, $v)
		);

		// NBT
		$registry->register(
			"nbt",
			fn($in, $protocol) => CommonTypes::getNbtRoot($in),
			fn($out, $v, $protocol) => throw new \RuntimeException(
				"NBT write not implemented. If a packet requires NBT writing, " .
				"register it manually in ManualTypeRegistry as an opaque type."
			)
		);
	}
}