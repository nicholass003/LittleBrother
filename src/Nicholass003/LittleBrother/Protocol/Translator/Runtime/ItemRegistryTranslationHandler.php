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

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\ItemTypeEntry;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\ItemRegistryPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\Convert\Item\ItemRuntimeIdMapper;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketHandler;
use function assert;

class ItemRegistryTranslationHandler implements RuntimePacketHandler{

	public function __construct(
		private ItemRuntimeIdMapper $itemMapper
	){}

	public function translate(int $protocol, Packet $packet, bool $inbound) : void{
		assert($packet instanceof ItemRegistryPacket);

		$itemMapper = $this->itemMapper->get($protocol);
		if($itemMapper === null){
			return;
		}

		$entries = [];
		foreach($packet->entries as $i => $entry){
			$entries[$i] = new ItemTypeEntry(
				$inbound ? $itemMapper->stringIdClientToServer($entry->stringId) : $itemMapper->stringIdServerToClient($entry->stringId),
				$inbound ? $itemMapper->clientToServer($entry->numericId) : $itemMapper->serverToClient($entry->numericId),
				$entry->componentBased,
				$entry->version,
				$entry->componentNbt
			);
		}
	}
}