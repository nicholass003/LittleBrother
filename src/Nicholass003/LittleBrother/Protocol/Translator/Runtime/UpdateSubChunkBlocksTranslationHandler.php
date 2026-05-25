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

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\SubChunk\UpdateSubChunkBlocksPacketEntry;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use function assert;

class UpdateSubChunkBlocksTranslationHandler extends RuntimeIdTranslationHandler{

	public function translate(int $protocol, Packet $packet, bool $inbound) : void{
		assert($packet instanceof UpdateSubChunkBlocksPacket);

		$layer0Updates = [];
		foreach($packet->layer0Updates as $v){
			$layer0Updates[] = new UpdateSubChunkBlocksPacketEntry(
				$v->blockPosition,
				$this->translateBlockId($v->blockRuntimeId, $protocol, $inbound),
				$v->flags,
				$v->syncedUpdateType,
				$v->actorUniqueId
			);
		}
		$packet->layer0Updates = $layer0Updates;
		$layer1Updates = [];
		foreach($packet->layer1Updates as $v){
			$layer1Updates[] = new UpdateSubChunkBlocksPacketEntry(
				$v->blockPosition,
				$this->translateBlockId($v->blockRuntimeId, $protocol, $inbound),
				$v->flags,
				$v->syncedUpdateType,
				$v->actorUniqueId
			);
		}
		$packet->layer1Updates = $layer1Updates;
	}
}