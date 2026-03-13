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

namespace Nicholass003\LittleBrother\Types;

use Nicholass003\LittleBrother\Convert\Block\BlockRuntimeIdMapper;
use Nicholass003\LittleBrother\Convert\Item\ItemRuntimeIdMapper;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

final class TypeRegistryFactory{

	private TypeRegistry $baseRegistry;

	public function __construct(
		TypeRegistry $baseRegistry,
		private BlockRuntimeIdMapper $blockMapper,
		private ItemRuntimeIdMapper $itemMapper
	){
		$this->baseRegistry = $baseRegistry;
		ManualTypeRegistry::register($this->baseRegistry);
	}

	/**
	 * Inbound (client → server):
	 *   clientRuntimeId → serverRuntimeId
	 */
	public function createForInbound(int $clientProtocol) : TypeRegistry{
		return $this->create($clientProtocol, inbound: true);
	}

	/**
	 * Outbound (server → client):
	 *   serverRuntimeId → clientRuntimeId
	 */
	public function createForOutbound(int $clientProtocol) : TypeRegistry{
		return $this->create($clientProtocol, inbound: false);
	}

	private function create(int $clientProtocol, bool $inbound) : TypeRegistry{
		$registry = clone $this->baseRegistry;
		$blockMapper = $this->blockMapper;
		$itemMapper = $this->itemMapper;

		$registry->register(
			'block_runtime_id',
			reader: static function(ByteBufferReader $in, int $protocol) use ($blockMapper, $clientProtocol, $inbound) : int{
				$id = VarInt::readUnsignedInt($in);
				$translator = $blockMapper->get($clientProtocol);
				if($translator === null) return $id;
				return $inbound
					? $translator->clientToServer($id)
					: $translator->serverToClient($id);
			},
			writer: static function(ByteBufferWriter $out, int $id, int $protocol) : void{
				VarInt::writeUnsignedInt($out, $id);
			}
		);

		$registry->register(
			'item_runtime_id',
			reader: static function(ByteBufferReader $in, int $protocol) use ($itemMapper, $clientProtocol, $inbound) : int{
				$id = VarInt::readSignedInt($in);
				if($id === 0) return 0;
				$translator = $itemMapper->get($clientProtocol);
				if($translator === null) return $id;
				return $inbound
					? $translator->clientToServer($id)
					: $translator->serverToClient($id);
			},
			writer: static function(ByteBufferWriter $out, int $id, int $protocol) : void{
				VarInt::writeSignedInt($out, $id);
			}
		);

		return $registry;
	}
}