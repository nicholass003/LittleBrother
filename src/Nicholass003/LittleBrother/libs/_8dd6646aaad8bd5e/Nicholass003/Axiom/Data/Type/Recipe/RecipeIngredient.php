<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Recipe;

final class RecipeIngredient{

    public function __construct(
        public readonly ?ItemDescriptor $descriptor,
        public readonly int $count
    ){}
}