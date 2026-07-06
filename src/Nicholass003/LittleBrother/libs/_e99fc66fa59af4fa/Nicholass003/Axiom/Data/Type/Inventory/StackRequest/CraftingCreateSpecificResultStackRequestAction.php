<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CraftingCreateSpecificResultStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $resultIndex
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_CREATE_SPECIFIC_RESULT);
    }
}