<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe;

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