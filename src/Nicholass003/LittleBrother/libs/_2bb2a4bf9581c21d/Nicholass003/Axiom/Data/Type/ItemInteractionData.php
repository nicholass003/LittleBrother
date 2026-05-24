<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;

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