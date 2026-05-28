<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Recipe;

final class MaterialReducerRecipe{

    /** @param list<MaterialReducerRecipeOutput> $outputs */
    public function __construct(
        public readonly int $inputItemId,
        public readonly int $inputItemMeta,
        public readonly array $outputs
    ){}
}