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
use Nicholass003\LittleBrother\Utils\Debugger;
use pocketmine\network\mcpe\convert\BlockStateDictionary;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\utils\Filesystem;
use function array_fill;
use function array_filter;
use function count;

final class RuntimeBlockMapper{

	/**
	 * Maps server runtime ID → client runtime ID.
	 * null = no mapping found (distinct from ID 0 which is a valid air block ID).
	 *
	 * @var array<int, array<int, int|null>>
	 */
	private array $serverToClientTables = [];

	/**
	 * Maps client runtime ID → server runtime ID.
	 * null = no mapping found.
	 *
	 * @var array<int, array<int, int|null>>
	 */
	private array $clientToServerTables = [];

	/** @var array<int, int> */
	private array $serverFallbackIds = [];

	/** @var array<int, int> */
	private array $clientFallbackIds = [];

	public function __construct(BedrockDataManager $manager){
		$serverDict = BlockStateDictionary::loadFromString(
			Filesystem::fileGetContents($manager->get(ProtocolInfo::CURRENT_PROTOCOL)->canonicalBlockStates()),
			Filesystem::fileGetContents($manager->get(ProtocolInfo::CURRENT_PROTOCOL)->blockStateMetaMap())
		);

		foreach(ProtocolVersion::SUPPORTED_PROTOCOLS as $protocol){
			if($protocol === ProtocolInfo::CURRENT_PROTOCOL){
				continue;
			}

			$clientDict = BlockStateDictionary::loadFromString(
				Filesystem::fileGetContents($manager->get($protocol)->canonicalBlockStates()),
				Filesystem::fileGetContents($manager->get($protocol)->blockStateMetaMap())
			);

			$this->buildTables($protocol, $serverDict, $clientDict);
		}
	}

	private function buildTables(int $protocol, BlockStateDictionary $server, BlockStateDictionary $client) : void{
		$serverStates = $server->getStates();
		$clientStates = $client->getStates();
		$serverCount = count($serverStates);
		$clientCount = count($clientStates);

		// null = unmapped. This is critical: 0 is a valid runtime ID (air),
		// so using 0 as "not found" silently corrupts air block translation.
		$serverToClient = array_fill(0, $serverCount, null);
		$clientToServer = array_fill(0, $clientCount, null);

		for($i = 0; $i < $serverCount; $i++){
			$state = $server->generateDataFromStateId($i);
			if($state === null) continue;
			$clientId = $client->lookupStateIdFromData($state);
			if($clientId !== null){
				$serverToClient[$i] = $clientId;
			}
		}

		for($i = 0; $i < $clientCount; $i++){
			$state = $client->generateDataFromStateId($i);
			if($state === null) continue;
			$serverId = $server->lookupStateIdFromData($state);
			if($serverId !== null){
				$clientToServer[$i] = $serverId;
			}
		}

		$this->serverToClientTables[$protocol] = $serverToClient;
		$this->clientToServerTables[$protocol] = $clientToServer;

		$this->buildFallbacks($protocol, $serverToClient, $clientToServer);

		$mapped = count(array_filter($serverToClient, fn($v) => $v !== null));
		Debugger::log("RuntimeBlockMapper: protocol=$protocol serverMapped=$mapped/$serverCount");
	}

	private function buildFallbacks(int $protocol, array $serverToClient, array $clientToServer) : void{
		// Fallback: use the first successfully mapped ID rather than hardcoded 0,
		// so unknown blocks become some valid client block instead of possibly air.
		$this->serverFallbackIds[$protocol] = 0;
		foreach($serverToClient as $clientId){
			if($clientId !== null){
				$this->serverFallbackIds[$protocol] = $clientId;
				break;
			}
		}

		$this->clientFallbackIds[$protocol] = 0;
		foreach($clientToServer as $serverId){
			if($serverId !== null){
				$this->clientFallbackIds[$protocol] = $serverId;
				break;
			}
		}
	}

	public function serverToClient(int $protocol, int $runtimeId) : int{
		$table = $this->serverToClientTables[$protocol] ?? null;

		if($table === null){
			return $runtimeId;
		}

		$mapped = $table[$runtimeId] ?? null;

		if($mapped !== null){
			return $mapped;
		}

		$fallback = $this->serverFallbackIds[$protocol] ?? 0;
		Debugger::log("RuntimeBlockMapper: serverToClient id=$runtimeId not found for protocol=$protocol, fallback=$fallback");
		return $fallback;
	}

	public function clientToServer(int $protocol, int $runtimeId) : int{
		$table = $this->clientToServerTables[$protocol] ?? null;

		if($table === null){
			return $runtimeId;
		}

		$mapped = $table[$runtimeId] ?? null;

		if($mapped !== null){
			return $mapped;
		}

		$fallback = $this->clientFallbackIds[$protocol] ?? 0;
		Debugger::log("RuntimeBlockMapper: clientToServer id=$runtimeId not found for protocol=$protocol, fallback=$fallback");
		return $fallback;
	}

	public function getMappingStats(int $protocol) : array{
		$serverTable = $this->serverToClientTables[$protocol] ?? [];
		$clientTable = $this->clientToServerTables[$protocol] ?? [];
		return [
			'server_total' => count($serverTable),
			'server_mapped' => count(array_filter($serverTable, fn($v) => $v !== null)),
			'client_total' => count($clientTable),
			'client_mapped' => count(array_filter($clientTable, fn($v) => $v !== null)),
		];
	}
}