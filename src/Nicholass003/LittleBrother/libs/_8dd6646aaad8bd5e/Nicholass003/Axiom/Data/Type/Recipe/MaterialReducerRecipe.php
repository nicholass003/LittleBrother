<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe;

final class MaterialReducerRecipe{

    /** @param list<MaterialReducerRecipeOutput> $outputs */
    public function __construct(
        public readonly int $inputItemId,
        public readonly int $inputItemMeta,
        public readonly array $outputs
    ){}
}