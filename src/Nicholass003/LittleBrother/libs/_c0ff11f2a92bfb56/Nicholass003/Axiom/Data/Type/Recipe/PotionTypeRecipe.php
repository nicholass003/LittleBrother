<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe;

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