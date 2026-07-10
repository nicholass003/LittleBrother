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

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\Convert\Block\RuntimeBlockMapper;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketHandler;

abstract class RuntimeIdTranslationHandler implements RuntimePacketHandler{

	public function __construct(
		protected RuntimeBlockMapper $blockMapper
	){}

	/**
	 * @param int    $protocol The target protocol version.
	 * @param Packet $packet   The packet to handle.
	 * @param bool   $inbound  True for inbound (client->server), false for outbound (server->client).
	 */
	abstract public function translate(int $protocol, Packet $packet, bool $inbound) : void;

	/**
	 * Translates a block runtime ID.
	 *
	 * @param int  $blockRuntimeId The block runtime ID to translate.
	 * @param int  $protocol       The target protocol version.
	 * @param bool $inbound        True for inbound (client->server), false for outbound (server->client).
	 * @return int The translated block runtime ID.
	 */
	protected function translateBlockId(int $blockRuntimeId, int $protocol, bool $inbound) : int{
		return $inbound ? $this->blockMapper->clientToServer($protocol, $blockRuntimeId) : $this->blockMapper->serverToClient($protocol, $blockRuntimeId);
	}
}