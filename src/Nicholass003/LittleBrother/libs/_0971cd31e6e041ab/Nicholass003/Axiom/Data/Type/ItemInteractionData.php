<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\UseItemTransactionData;

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