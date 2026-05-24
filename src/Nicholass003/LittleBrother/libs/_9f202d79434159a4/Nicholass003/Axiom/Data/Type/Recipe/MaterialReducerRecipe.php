<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Recipe;

final class MaterialReducerRecipe{

    /** @param list<MaterialReducerRecipeOutput> $outputs */
    public function __construct(
        public readonly int $inputItemId,
        public readonly int $inputItemMeta,
        public readonly array $outputs
    ){}
}