<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory;

final class InventoryTransactionChangedSlotsHack{

    /**
     * @param list<int> $changedSlotIndexes
     */
    public function __construct(
        public readonly int $containerId,
        public readonly array $changedSlotIndexes
    ){}
}