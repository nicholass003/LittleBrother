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

namespace Nicholass003\LittleBrother\Convert;

use pocketmine\network\mcpe\protocol\ProtocolInfo;
use RuntimeException;

use function array_keys;
use function is_dir;
use function is_numeric;
use function scandir;
use const pocketmine\BEDROCK_DATA_PATH;

final class BedrockDataManager {

	/** Resolved protocol dirs */
	private array $protocolDirs = [];

	/** BedrockData instances */
	private array $protocols = [];

	public function __construct(
		private string $dataPath
	) {
		$this->scanDirs();
	}

	private function scanDirs() : void {
		$base = $this->dataPath . '/bedrock';

		if (!is_dir($base)) {
			throw new RuntimeException("Bedrock data folder missing: $base");
		}

		foreach (scandir($base) as $dir) {
			if (!is_numeric($dir)) {
				continue;
			}
			$this->protocolDirs[(int) $dir] = $base . '/' . $dir;
		}

		$this->protocolDirs[ProtocolInfo::CURRENT_PROTOCOL] = BEDROCK_DATA_PATH;
	}

	public function get(int $protocol) : BedrockData {
		if (!isset($this->protocolDirs[$protocol])) {
			throw new RuntimeException("Unsupported protocol $protocol");
		}

		return $this->protocols[$protocol] ??= new BedrockData(
			$protocol,
			$this->protocolDirs[$protocol]
		);
	}

	public function getSupportedProtocols() : array {
		return array_keys($this->protocolDirs);
	}
}