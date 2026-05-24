<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Recipe;

final class MultiRecipe extends RecipeWithTypeId{

    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}