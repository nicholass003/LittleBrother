<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\RecipeIngredient;

class CraftRecipeAutoStackRequestAction extends ItemStackRequestAction{

    /**
     * @param list<RecipeIngredient> $ingredients
     */
    public function __construct(
        public readonly int $recipeId,
        public readonly int $repetitions,
        public readonly int $repetitions2,
        public readonly array $ingredients
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_RECIPE_AUTO);
    }
}