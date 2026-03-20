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

use Nicholass003\LittleBrother\Convert\Block\RuntimeBlockMapper;
use Nicholass003\LittleBrother\Convert\Item\ItemRuntimeIdMapper;
use Nicholass003\LittleBrother\Schema\PacketContext;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;

final class TypeRegistryFactory{

	private TypeRegistry $baseRegistry;
	private array $inboundCache = [];
	private array $outboundCache = [];

	public function __construct(
		TypeRegistry $baseRegistry,
		private RuntimeBlockMapper $blockMapper,
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
		return $this->inboundCache[$clientProtocol] ??= $this->create($clientProtocol, inbound: true);
	}

	/**
	 * Outbound (server → client):
	 *   serverRuntimeId → clientRuntimeId
	 */
	public function createForOutbound(int $clientProtocol) : TypeRegistry{
		return $this->outboundCache[$clientProtocol] ??= $this->create($clientProtocol, inbound: false);
	}

	private function create(int $clientProtocol, bool $inbound) : TypeRegistry{
		$registry = $this->baseRegistry;
		$blockMapper = $this->blockMapper;
		$itemMapper = $this->itemMapper;

		$registry->register(
			'block_runtime_id',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use ($blockMapper, $clientProtocol, $inbound) : int{
				$id = VarInt::readUnsignedInt($in);
				return $inbound
					? $blockMapper->clientToServer($protocol, $id)
					: $blockMapper->serverToClient($protocol, $id);
			},
			writer: static function(ByteBufferWriter $out, int $id, int $protocol, PacketContext $context) : void{
				VarInt::writeUnsignedInt($out, $id);
			}
		);

		$registry->register(
			'item_runtime_id',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use ($itemMapper, $clientProtocol, $inbound) : int{
				$id = VarInt::readSignedInt($in);
				if($id === 0) return 0;
				$translator = $itemMapper->get($clientProtocol);
				if($translator === null) return $id;
				return $inbound
					? $translator->clientToServer($id)
					: $translator->serverToClient($id);
			},
			writer: static function(ByteBufferWriter $out, int $id, int $protocol, PacketContext $context) : void{
				VarInt::writeSignedInt($out, $id);
			}
		);

		$registry->register(
			'item_stack_wrapper',
			reader: static function(ByteBufferReader $in, int $protocol, PacketContext $context) use ($blockMapper, $itemMapper, $clientProtocol, $inbound) : ItemStackWrapper{
				$wrapper = CommonTypes::getItemStackWrapper($in);
				$stack = $wrapper->getItemStack();

				if($stack->isNull()) return $wrapper;

				$translator = $itemMapper->get($clientProtocol);
				if($translator === null) return $wrapper;

				$remappedId = $inbound
					? $translator->clientToServer($stack->getId())
					: $translator->serverToClient($stack->getId());

				if($remappedId === $stack->getId()) return $wrapper;
				$blockRuntimeId = $stack->getBlockRuntimeId();

				if($blockRuntimeId !== 0){
						$blockRuntimeId = $inbound
							? $blockMapper->clientToServer($protocol, $blockRuntimeId)
							: $blockMapper->serverToClient($protocol, $blockRuntimeId);
				}

				$remappedStack = new ItemStack(
					$remappedId,
					$stack->getMeta(),
					$stack->getCount(),
					$blockRuntimeId,
					$stack->getRawExtraData()
				);

				return new ItemStackWrapper($wrapper->getStackId(), $remappedStack);
			},
			writer: static function(ByteBufferWriter $out, ItemStackWrapper $wrapper, int $protocol) : void{
				CommonTypes::putItemStackWrapper($out, $wrapper);
			}
		);

		return $registry;
	}

	public function getTypeRegistry() : TypeRegistry{
		return $this->baseRegistry;
	}
}