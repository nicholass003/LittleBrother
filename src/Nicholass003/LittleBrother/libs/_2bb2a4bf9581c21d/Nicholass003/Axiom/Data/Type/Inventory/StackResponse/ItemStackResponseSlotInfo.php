<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

class ItemStackResponseSlotInfo{

    public function __construct(
        public readonly int $slot,
        public readonly int $hotbarSlot,
        public readonly int $count,
        public readonly int $itemStackId,
        public readonly string $customName,
        public readonly string $filteredCustomName,
        public readonly int $durabilityCorrection
    ){}
}