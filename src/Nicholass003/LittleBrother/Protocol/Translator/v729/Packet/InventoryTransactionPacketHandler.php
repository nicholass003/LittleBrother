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

namespace Nicholass003\LittleBrother\Protocol\Translator\v729\Packet;

use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketHandler;
use Nicholass003\LittleBrother\Schema\PacketContext;
use Nicholass003\LittleBrother\Types\TypeRegistry;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\PacketDecodeException;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class InventoryTransactionPacketHandler extends ManualPacketHandler{

	private const TYPE_NORMAL = 0;
	private const TYPE_MISMATCH = 1;
	private const TYPE_USE_ITEM = 2;
	private const TYPE_USE_ITEM_ON_ENTITY = 3;
	private const TYPE_RELEASE_ITEM = 4;

	private TypeRegistry $typeRegistry;

	public function __construct(TypeRegistry $typeRegistry){
		$this->typeRegistry = $typeRegistry;
		parent::__construct($typeRegistry->getPlugin());
	}

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		return $this->translate($in, $protocol);
	}

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		return $this->translate($in, $protocol);
	}

	private function translate(ByteBufferReader $in, int $protocol) : string{
		$out = new ByteBufferWriter();
		$context = new PacketContext($this->typeRegistry);

		// requestId
		$requestId = CommonTypes::readLegacyItemStackRequestId($in);
		CommonTypes::writeLegacyItemStackRequestId($out, $requestId);

		if($requestId !== 0){
			$changedSlotsCount = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $changedSlotsCount);

			for($i = 0; $i < $changedSlotsCount; $i++){
				$containerId = Byte::readUnsigned($in);
				Byte::writeUnsigned($out, $containerId);

				$slotsCount = VarInt::readUnsignedInt($in);
				VarInt::writeUnsignedInt($out, $slotsCount);

				for($j = 0; $j < $slotsCount; $j++){
					$slotValue = Byte::readUnsigned($in);
					Byte::writeUnsigned($out, $slotValue);
				}
			}
		}

		// transaction type
		$transactionType = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $transactionType);

		switch($transactionType){
			case self::TYPE_NORMAL:
				$this->readWriteNormalTransactionData($in, $out, $context, $protocol);
				break;
			case self::TYPE_MISMATCH:
				$this->readWriteMismatchTransactionData($in, $out, $context, $protocol);
				break;
			case self::TYPE_USE_ITEM:
				$this->readWriteUseItemTransactionData($in, $out, $context, $protocol);
				break;
			case self::TYPE_USE_ITEM_ON_ENTITY:
				$this->readWriteUseItemOnEntityTransactionData($in, $out, $context, $protocol);
				break;
			case self::TYPE_RELEASE_ITEM:
				$this->readWriteReleaseItemTransactionData($in, $out, $context, $protocol);
				break;
			default:
				throw new PacketDecodeException("Unknown transaction type $transactionType");
		}

		return $out->getData();
	}

	private function readWriteNormalTransactionData(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$this->readWriteNetworkInventoryActions($in, $out, $context, $protocol);
	}

	private function readWriteMismatchTransactionData(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$this->readWriteNetworkInventoryActions($in, $out, $context, $protocol);
	}

	private function readWriteUseItemTransactionData(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$this->readWriteNetworkInventoryActions($in, $out, $context, $protocol);

		// actionType
		$actionType = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $actionType);

		// triggerType
		$triggerType = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $triggerType);

		// blockPosition
		$blockPosition = $this->typeRegistry->read($in, 'blockpos', $protocol, $context);
		$this->typeRegistry->write($out, 'blockpos', $blockPosition, $protocol, $context);

		// face
		$face = VarInt::readSignedInt($in);
		VarInt::writeSignedInt($out, $face);

		// hotbarSlot
		$hotbarSlot = VarInt::readSignedInt($in);
		VarInt::writeSignedInt($out, $hotbarSlot);

		// itemInHand
		$itemInHand = $this->typeRegistry->read($in, 'item_stack_wrapper', $protocol, $context);
		$this->typeRegistry->write($out, 'item_stack_wrapper', $itemInHand, $protocol, $context);

		// playerPosition
		$playerPosition = $this->typeRegistry->read($in, 'vector3', $protocol, $context);
		$this->typeRegistry->write($out, 'vector3', $playerPosition, $protocol, $context);

		// clickPosition
		$clickPosition = $this->typeRegistry->read($in, 'vector3', $protocol, $context);
		$this->typeRegistry->write($out, 'vector3', $clickPosition, $protocol, $context);

		// blockRuntimeId
		$blockRuntimeId = $this->typeRegistry->read($in, 'block_runtime_id', $protocol, $context);
		$this->typeRegistry->write($out, 'block_runtime_id', $blockRuntimeId, $protocol, $context);

		// clientInteractPrediction
		$clientInteractPrediction = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $clientInteractPrediction);

		// clientCooldownState
		if($protocol >= ProtocolVersion::BE_1_26_10){
			$clientCooldownState = Byte::readUnsigned($in);
			Byte::writeUnsigned($out, $clientCooldownState);
		}else{
			Byte::writeUnsigned($out, 0);
		}
	}

	private function readWriteUseItemOnEntityTransactionData(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$this->readWriteNetworkInventoryActions($in, $out, $context, $protocol);

		$actorRuntimeId = $this->typeRegistry->read($in, 'actor_runtime_id', $protocol, $context);
		$this->typeRegistry->write($out, 'actor_runtime_id', $actorRuntimeId, $protocol, $context);

		$actionType = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $actionType);

		$hotbarSlot = VarInt::readSignedInt($in);
		VarInt::writeSignedInt($out, $hotbarSlot);

		$itemInHand = $this->typeRegistry->read($in, 'item_stack_wrapper', $protocol, $context);
		$this->typeRegistry->write($out, 'item_stack_wrapper', $itemInHand, $protocol, $context);

		$playerPosition = $this->typeRegistry->read($in, 'vector3', $protocol, $context);
		$this->typeRegistry->write($out, 'vector3', $playerPosition, $protocol, $context);

		$clickPosition = $this->typeRegistry->read($in, 'vector3', $protocol, $context);
		$this->typeRegistry->write($out, 'vector3', $clickPosition, $protocol, $context);
	}

	private function readWriteReleaseItemTransactionData(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$this->readWriteNetworkInventoryActions($in, $out, $context, $protocol);

		$actionType = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $actionType);

		$hotbarSlot = VarInt::readSignedInt($in);
		VarInt::writeSignedInt($out, $hotbarSlot);

		$itemInHand = $this->typeRegistry->read($in, 'item_stack_wrapper', $protocol, $context);
		$this->typeRegistry->write($out, 'item_stack_wrapper', $itemInHand, $protocol, $context);

		$headPosition = $this->typeRegistry->read($in, 'vector3', $protocol, $context);
		$this->typeRegistry->write($out, 'vector3', $headPosition, $protocol, $context);
	}

	private function readWriteNetworkInventoryActions(ByteBufferReader $in, ByteBufferWriter $out, PacketContext $context, int $protocol) : void{
		$actionCount = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $actionCount);

		for($i = 0; $i < $actionCount; $i++){
			$sourceType = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $sourceType);

			switch($sourceType){
				case 0: // SOURCE_CONTAINER
				case 99999: // SOURCE_TODO
					$windowId = VarInt::readSignedInt($in);
					VarInt::writeSignedInt($out, $windowId);
					break;
				case 2: // SOURCE_WORLD
					$sourceFlags = VarInt::readUnsignedInt($in);
					VarInt::writeUnsignedInt($out, $sourceFlags);
					break;
				case 3: // SOURCE_CREATIVE
					break;
				default:
					break;
			}

			$inventorySlot = VarInt::readUnsignedInt($in);
			VarInt::writeUnsignedInt($out, $inventorySlot);

			// old item
			try{
				$oldItem = $this->typeRegistry->read($in, 'item_stack_wrapper', $protocol, $context);
				$this->typeRegistry->write($out, 'item_stack_wrapper', $oldItem, $protocol, $context);
			}catch(\Exception $e){
				return;
			}

			// new item
			try{
				$newItem = $this->typeRegistry->read($in, 'item_stack_wrapper', $protocol, $context);
				$this->typeRegistry->write($out, 'item_stack_wrapper', $newItem, $protocol, $context);
			}catch(\Exception $e){
				return;
			}
		}
	}
}