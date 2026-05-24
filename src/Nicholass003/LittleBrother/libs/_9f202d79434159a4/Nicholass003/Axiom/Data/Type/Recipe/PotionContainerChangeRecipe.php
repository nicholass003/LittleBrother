<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Recipe;

final class PotionContainerChangeRecipe{

    public function __construct(
        public readonly int $inputItemId,
        public readonly int $ingredientItemId,
        public readonly int $outputItemId
    ){}
}