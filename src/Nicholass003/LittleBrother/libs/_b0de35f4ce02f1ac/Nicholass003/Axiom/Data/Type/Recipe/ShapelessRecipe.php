<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\ItemStack;

final class ShapelessRecipe extends RecipeWithTypeId{

    /**
     * @param list<RecipeIngredient> $inputs
     * @param list<ItemStack> $outputs
     */
    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly array $inputs,
        public readonly array $outputs,
        public readonly string $uuid,
        public readonly string $blockName,
        public readonly int $priority,
        public readonly RecipeUnlockingRequirement $unlockingRequirement,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}