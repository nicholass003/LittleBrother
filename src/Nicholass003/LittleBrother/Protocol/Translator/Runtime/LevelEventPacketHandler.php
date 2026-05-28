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

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\LevelEventType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\LevelEventPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use function assert;

final class LevelEventPacketHandler extends RuntimeIdTranslationHandler{

	public function translate(int $protocol, Packet $packet, bool $inbound) : void{
		assert($packet instanceof LevelEventPacket);

		if($inbound){
			return;
		}

		$eventId = $packet->eventId;
		$data = $packet->eventData;

		$packet->eventData = match($eventId){
			LevelEventType::PARTICLE_DESTROY,
			LevelEventType::PARTICLE_BLOCK_FORCE_FIELD,
			LevelEventType::PARTICLE_BLOCK_EXPLODE,
			LevelEventType::BLOCK_START_BREAK,
			LevelEventType::BLOCK_STOP_BREAK => $this->translateBlockId($data, $protocol, $inbound),
			LevelEventType::PARTICLE_PUNCH_BLOCK => $this->translatePunchBlock($data, $protocol, $inbound),
			default => $data,
		};
	}

	private function translatePunchBlock(int $data, int $protocol, bool $inbound) : int{
		$blockRuntimeId = $data & 0xFFFFFF;
		$face = ($data >> 24) & 0xFF;

		$newBlockId = $this->translateBlockId($blockRuntimeId, $protocol, $inbound);
		return $newBlockId | ($face << 24);
	}
}