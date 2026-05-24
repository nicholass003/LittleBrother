<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe;

final class RecipeIngredient{

    public function __construct(
        public readonly ?ItemDescriptor $descriptor,
        public readonly int $count
    ){}
}