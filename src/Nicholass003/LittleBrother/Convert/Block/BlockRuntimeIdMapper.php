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

namespace Nicholass003\LittleBrother\Convert\Block;

use Nicholass003\LittleBrother\Convert\BedrockDataManager;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

final class BlockRuntimeIdMapper{

	/** @var BlockRuntimeIdTranslator[] key = clientProtocol */
	private array $translators = [];

	public function __construct(
		BedrockDataManager $manager
	){
		$serverDict = new BlockStateDictionary(
			$manager->get(ProtocolInfo::CURRENT_PROTOCOL)->canonicalBlockStates(),
			$manager->get(ProtocolInfo::CURRENT_PROTOCOL)->blockStateMetaMap()
		);
		foreach(ProtocolVersion::SUPPORTED_PROTOCOLS as $protocol){
			if($protocol === ProtocolInfo::CURRENT_PROTOCOL) continue;

			$clientDict = new BlockStateDictionary(
				$manager->get($protocol)->canonicalBlockStates(),
				$manager->get($protocol)->blockStateMetaMap()
			);

			$this->translators[$protocol] = new BlockRuntimeIdTranslator(
				$serverDict,
				$clientDict
			);
		}
	}

	public function get(int $protocol) : ?BlockRuntimeIdTranslator{
		if($protocol === ProtocolInfo::CURRENT_PROTOCOL){
			return null;
		}
		return $this->translators[$protocol] ?? null;
	}
}