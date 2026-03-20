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

namespace Nicholass003\LittleBrother\Protocol\Translator;

final class ManualPacketRegistry{

	/** @var array<int, ManualPacketHandler> */
	private array $handlers = [];

	/** @var array<int, bool> */
	private array $batchOnlyHandlers = [];

	public function register(int $packetId, ManualPacketHandler $handler, bool $batchOnly = false) : void{
		$this->handlers[$packetId] = $handler;
		if($batchOnly === true){
			$this->batchOnlyHandlers[$packetId] = true;
		}
	}

	public function get(int $packetId) : ?ManualPacketHandler{
		return $this->handlers[$packetId] ?? null;
	}

	public function isBatchOnly(int $packetId) : bool{
		return isset($this->batchOnlyHandlers[$packetId]);
	}
}