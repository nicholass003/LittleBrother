<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Recipe;

final class SmithingTrimRecipe extends RecipeWithTypeId{

    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly RecipeIngredient $template,
        public readonly RecipeIngredient $input,
        public readonly RecipeIngredient $addition,
        public readonly string $blockName,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}