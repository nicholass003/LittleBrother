<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CraftingCreateSpecificResultStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $resultIndex
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_CREATE_SPECIFIC_RESULT);
    }
}