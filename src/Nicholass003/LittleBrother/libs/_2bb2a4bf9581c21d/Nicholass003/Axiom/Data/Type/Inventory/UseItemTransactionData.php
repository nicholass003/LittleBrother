<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\PredictedResult;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\TriggerType;

final class UseItemTransactionData implements TransactionData{

    public readonly int $clientCooldownState;

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    public function __construct(
        public readonly array $actions,
        public readonly int $actionType,
        public readonly TriggerType $triggerType,
        public readonly BlockPosition $blockPosition,
        public readonly int $face,
        public readonly int $hotbarSlot,
        public readonly ItemStackWrapper $itemInHand,
        public readonly Vec3 $playerPosition,
        public readonly Vec3 $clickPosition,
        public readonly int $blockRuntimeId,
        public readonly PredictedResult $clientInteractPrediction,
        int $clientCooldownState = 0
    ){
        $this->clientCooldownState = $clientCooldownState;
    }
}