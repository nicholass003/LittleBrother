<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class MineBlockStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $hotbarSlot,
        public readonly int $predictedDurability,
        public readonly int $stackId
    ){
        parent::__construct(ItemStackRequestActionType::MINE_BLOCK);
    }
}