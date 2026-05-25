<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;

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