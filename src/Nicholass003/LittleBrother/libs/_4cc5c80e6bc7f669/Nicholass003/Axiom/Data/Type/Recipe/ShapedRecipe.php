<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\ItemStack;

final class ShapedRecipe extends RecipeWithTypeId{

    /**
     * @param list<list<RecipeIngredient>> $input
     * @param list<ItemStack> $output
     */
    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly array $input,
        public readonly array $output,
        public readonly string $uuid,
        public readonly string $blockName,
        public readonly int $priority,
        public readonly bool $symmetric,
        public readonly RecipeUnlockingRequirement $unlockingRequirement,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}