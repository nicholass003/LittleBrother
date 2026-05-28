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

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\NetworkInventoryAction;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\ReleaseItemTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\TransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\UseItemOnEntityTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\InventoryTransactionPacket;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use function assert;

class InventoryTransactionTranslationHandler extends ItemStackWrapperTranslationHandler{

	public function translate(int $protocol, Packet $packet, bool $inbound) : void{
		assert($packet instanceof InventoryTransactionPacket);

		$trData = $packet->trData;
		$translatedTrData = $this->translateTransactionData($trData, $protocol, $inbound);

		if($translatedTrData !== $trData){
			$packet->trData = $translatedTrData;
		}
	}

	private function translateTransactionData(TransactionData $trData, int $protocol, bool $inbound) : TransactionData{
		return match(true){
			$trData instanceof ReleaseItemTransactionData => $this->translateReleaseItem($trData, $protocol, $inbound),
			$trData instanceof UseItemOnEntityTransactionData => $this->translateUseItemOnEntity($trData, $protocol, $inbound),
			$trData instanceof UseItemTransactionData => $this->translateUseItem($trData, $protocol, $inbound),
			default => $trData,
		};
	}

	private function translateReleaseItem(ReleaseItemTransactionData $data, int $protocol, bool $inbound) : ReleaseItemTransactionData{
		$actions = $this->translateActions($data->actions, $protocol, $inbound);
		$itemInHand = $this->translateWrapper($data->itemInHand, $protocol, $inbound);

		return new ReleaseItemTransactionData(
			actions: $actions,
			actionType: $data->actionType,
			hotbarSlot: $data->hotbarSlot,
			itemInHand: $itemInHand,
			headPosition: $data->headPosition
		);
	}

	private function translateUseItemOnEntity(UseItemOnEntityTransactionData $data, int $protocol, bool $inbound) : UseItemOnEntityTransactionData{
		$actions = $this->translateActions($data->actions, $protocol, $inbound);
		$itemInHand = $this->translateWrapper($data->itemInHand, $protocol, $inbound);

		return new UseItemOnEntityTransactionData(
			actions: $actions,
			actorRuntimeId: $data->actorRuntimeId,
			actionType: $data->actionType,
			hotbarSlot: $data->hotbarSlot,
			itemInHand: $itemInHand,
			playerPosition: $data->playerPosition,
			clickPosition: $data->clickPosition
		);
	}

	private function translateUseItem(UseItemTransactionData $data, int $protocol, bool $inbound) : UseItemTransactionData{
		$actions = $this->translateActions($data->actions, $protocol, $inbound);
		$itemInHand = $this->translateWrapper($data->itemInHand, $protocol, $inbound);

		return new UseItemTransactionData(
			actions: $actions,
			actionType: $data->actionType,
			triggerType: $data->triggerType,
			blockPosition: $data->blockPosition,
			face: $data->face,
			hotbarSlot: $data->hotbarSlot,
			itemInHand: $itemInHand,
			playerPosition: $data->playerPosition,
			clickPosition: $data->clickPosition,
			blockRuntimeId: $this->translateBlockId($data->blockRuntimeId, $protocol, $inbound),
			clientInteractPrediction: $data->clientInteractPrediction,
			clientCooldownState: $data->clientCooldownState
		);
	}

	/**
	 * @param array<NetworkInventoryAction> $actions
	 * @return array<NetworkInventoryAction>
	 */
	private function translateActions(array $actions, int $protocol, bool $inbound) : array{
		$newActions = [];
		foreach($actions as $action){
			$newOldItem = $action->oldItem !== null ? $this->translateWrapper($action->oldItem, $protocol, $inbound) : null;
			$newNewItem = $action->newItem !== null ? $this->translateWrapper($action->newItem, $protocol, $inbound) : null;

			$newActions[] = new NetworkInventoryAction(
				sourceType: $action->sourceType,
				windowId: $action->windowId,
				sourceFlags: $action->sourceFlags,
				inventorySlot: $action->inventorySlot,
				oldItem: $newOldItem,
				newItem: $newNewItem
			);
		}
		return $newActions;
	}
}