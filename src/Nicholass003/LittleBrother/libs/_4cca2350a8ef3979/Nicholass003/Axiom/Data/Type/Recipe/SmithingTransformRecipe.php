<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Recipe;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\ItemStack;

final class SmithingTransformRecipe extends RecipeWithTypeId{

    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly RecipeIngredient $template,
        public readonly RecipeIngredient $input,
        public readonly RecipeIngredient $addition,
        public readonly ItemStack $output,
        public readonly string $blockName,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}