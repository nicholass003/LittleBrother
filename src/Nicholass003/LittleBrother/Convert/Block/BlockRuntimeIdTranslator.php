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

final class BlockRuntimeIdTranslator{

	/** @var int[] */
	private array $serverToClientTable = [];

	/** @var int[] */
	private array $clientToServerTable = [];

	public function __construct(
		BlockStateDictionary $server,
		BlockStateDictionary $client
	){
		$serverCount = $server->count();
		for($i = 0; $i < $serverCount; $i++){
			$hash = $server->runtimeIdToHash($i);
			$clientId = $client->hashToRuntimeId($hash);
			$this->serverToClientTable[$i] = $clientId ?? 0;
		}

		$clientCount = $client->count();
		for($i = 0; $i < $clientCount; $i++){
			$hash = $client->runtimeIdToHash($i);
			$serverId = $server->hashToRuntimeId($hash);
			$this->clientToServerTable[$i] = $serverId ?? 0;
		}
	}

	/**
	 * Outbound: server runtime ID → client runtime ID.
	 */
	public function serverToClient(int $serverRuntimeId) : int{
		return $this->serverToClientTable[$serverRuntimeId] ?? 0;
	}

	/**
	 * Inbound: client runtime ID → server runtime ID.
	 */
	public function clientToServer(int $clientRuntimeId) : int{
		return $this->clientToServerTable[$clientRuntimeId] ?? 0;
	}
}