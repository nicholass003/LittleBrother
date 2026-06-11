<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Recipe;

final class PotionContainerChangeRecipe{

    public function __construct(
        public readonly int $inputItemId,
        public readonly int $ingredientItemId,
        public readonly int $outputItemId
    ){}
}