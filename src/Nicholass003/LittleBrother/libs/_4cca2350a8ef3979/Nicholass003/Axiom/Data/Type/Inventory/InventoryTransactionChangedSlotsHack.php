<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory;

final class InventoryTransactionChangedSlotsHack{

    /**
     * @param list<int> $changedSlotIndexes
     */
    public function __construct(
        public readonly int $containerId,
        public readonly array $changedSlotIndexes
    ){}
}