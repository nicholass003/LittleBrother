<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Recipe;

final class RecipeUnlockingRequirement{

    /** @param list<RecipeIngredient>|null $unlockingIngredients */
    public function __construct(
        public readonly ?array $unlockingIngredients
    ){}
}