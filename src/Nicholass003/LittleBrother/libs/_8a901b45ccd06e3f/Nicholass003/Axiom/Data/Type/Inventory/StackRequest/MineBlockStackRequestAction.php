<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class MineBlockStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $hotbarSlot,
        public readonly int $predictedDurability,
        public readonly int $stackId
    ){
        parent::__construct(ItemStackRequestActionType::MINE_BLOCK);
    }
}