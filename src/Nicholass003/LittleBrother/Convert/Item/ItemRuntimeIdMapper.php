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

namespace Nicholass003\LittleBrother\Convert\Item;

use Nicholass003\LittleBrother\Convert\BedrockDataManager;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

final class ItemRuntimeIdMapper{

	/** @var ItemRuntimeIdTranslator[] key = clientProtocol */
	private array $translators = [];

	public function __construct(BedrockDataManager $manager){
		$serverDict = new ItemStateDictionary(
			$manager->get(ProtocolInfo::CURRENT_PROTOCOL)->requiredItemList()
		);

		foreach(ProtocolVersion::SUPPORTED_PROTOCOLS as $protocol){
			if($protocol === ProtocolInfo::CURRENT_PROTOCOL) continue;
			if(isset(ProtocolVersion::PARENT_PROTOCOLS[$protocol])){
				$protocol = ProtocolVersion::PARENT_PROTOCOLS[$protocol];
			}

			$clientDict = new ItemStateDictionary(
				$manager->get($protocol)->requiredItemList()
			);

			$this->translators[$protocol] = new ItemRuntimeIdTranslator(
				$serverDict,
				$clientDict
			);
		}
	}

	public function get(int $protocol) : ?ItemRuntimeIdTranslator{
		if($protocol === ProtocolInfo::CURRENT_PROTOCOL){
			return null;
		}
		return $this->translators[$protocol] ?? null;
	}
}