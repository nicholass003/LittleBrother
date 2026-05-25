<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CraftRecipeStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $recipeId,
        public readonly int $repetitions
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_RECIPE);
    }
}