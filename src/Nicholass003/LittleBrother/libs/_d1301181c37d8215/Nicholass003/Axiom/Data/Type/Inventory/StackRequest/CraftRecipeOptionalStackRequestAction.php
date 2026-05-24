<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CraftRecipeOptionalStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $recipeId,
        public readonly int $filterStringIndex
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_RECIPE_OPTIONAL);
    }
}