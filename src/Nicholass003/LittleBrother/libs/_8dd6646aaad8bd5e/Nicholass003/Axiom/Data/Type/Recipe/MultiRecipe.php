<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe;

final class MultiRecipe extends RecipeWithTypeId{

    public function __construct(
        int $typeId,
        public readonly string $recipeId,
        public readonly int $recipeNetId
    ){
        parent::__construct($typeId);
    }
}