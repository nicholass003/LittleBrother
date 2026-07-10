<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Recipe;

final class PotionTypeRecipe{

    public function __construct(
        public readonly int $inputItemId,
        public readonly int $inputItemMeta,
        public readonly int $ingredientItemId,
        public readonly int $ingredientItemMeta,
        public readonly int $outputItemId,
        public readonly int $outputItemMeta
    ){}
}