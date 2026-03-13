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

final class ItemRuntimeIdTranslator{

	/** @var int[] key = serverRuntimeId, value = clientRuntimeId */
	private array $serverToClient = [];

	/** @var int[] key = clientRuntimeId, value = serverRuntimeId */
	private array $clientToServer = [];

	public function __construct(
		ItemStateDictionary $server,
		ItemStateDictionary $client
	){
		foreach($server->getAll() as $runtimeId => $stringId){
			$clientId = $client->stringToRuntimeId($stringId);
			$this->serverToClient[$runtimeId] = $clientId ?? 0;
		}

		foreach($client->getAll() as $runtimeId => $stringId){
			$serverId = $server->stringToRuntimeId($stringId);
			$this->clientToServer[$runtimeId] = $serverId ?? 0;
		}
	}

	/**
	 * Outbound: server runtime ID → client runtime ID.
	 */
	public function serverToClient(int $serverRuntimeId) : int{
		if($serverRuntimeId === 0) return 0;
		return $this->serverToClient[$serverRuntimeId] ?? 0;
	}

	/**
	 * Inbound: client runtime ID → server runtime ID.
	 */
	public function clientToServer(int $clientRuntimeId) : int{
		if($clientRuntimeId === 0) return 0;
		return $this->clientToServer[$clientRuntimeId] ?? 0;
	}
}