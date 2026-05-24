<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\InventoryActionSourceType;

final class NetworkInventoryAction{

    public function __construct(
        public readonly InventoryActionSourceType $sourceType,
        public readonly ?int $windowId,
        public readonly int $sourceFlags,
        public readonly int $inventorySlot,
        public readonly ItemStackWrapper $oldItem,
        public readonly ItemStackWrapper $newItem
    ){}
}