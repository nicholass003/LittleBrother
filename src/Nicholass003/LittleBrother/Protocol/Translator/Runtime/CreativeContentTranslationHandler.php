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

namespace Nicholass003\LittleBrother\Protocol\Translator\Runtime;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\CreativeGroupEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\CreativeItemEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\ItemStack;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\CreativeContentPacket;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use function assert;

class CreativeContentTranslationHandler extends RuntimeIdTranslationHandler{

	public function translate(int $protocol, Packet $packet, bool $inbound) : void{
		assert($packet instanceof CreativeContentPacket);

		$groups = [];
		foreach($packet->groups as $i => $entry){
			$groups[$i] = new CreativeGroupEntry(
				$entry->categoryId,
				$entry->categoryName,
				new ItemStack(
					$entry->icon->id,
					$entry->icon->meta,
					$entry->icon->count,
					$this->translateBlockId($entry->icon->blockRuntimeId, $protocol, $inbound),
					$entry->icon->rawExtraData
				)
			);
		}
		$packet->groups = $groups;

		$items = [];
		foreach($packet->items as $i => $entry){
			$items[$i] = new CreativeItemEntry(
				$entry->entryId,
				new ItemStack(
					$entry->item->id,
					$entry->item->meta,
					$entry->item->count,
					$this->translateBlockId($entry->item->blockRuntimeId, $protocol, $inbound),
					$entry->item->rawExtraData
				),
				$entry->groupId
			);
		}
		$packet->items = $items;
	}
}