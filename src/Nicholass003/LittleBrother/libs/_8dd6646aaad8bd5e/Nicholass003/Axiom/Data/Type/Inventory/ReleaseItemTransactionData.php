<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Vec3;

final class ReleaseItemTransactionData implements TransactionData{

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    public function __construct(
        public readonly array $actions,
        public readonly int $actionType,
        public readonly int $hotbarSlot,
        public readonly ItemStackWrapper $itemInHand,
        public readonly Vec3 $headPosition
    ){}
}