<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec3;

final class UseItemOnEntityTransactionData implements TransactionData{

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    public function __construct(
        public readonly array $actions,
        public readonly int $actorRuntimeId,
        public readonly int $actionType,
        public readonly int $hotbarSlot,
        public readonly ItemStackWrapper $itemInHand,
        public readonly Vec3 $playerPosition,
        public readonly Vec3 $clickPosition
    ){}
}