<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;

class ItemInteractionData{

    /**
     * @param list<InventoryTransactionChangedSlotsHack> $requestChangedSlots
     */
    public function __construct(
        public readonly int $requestId,
        public readonly array $requestChangedSlots,
        public readonly UseItemTransactionData $transactionData
    ){}
}