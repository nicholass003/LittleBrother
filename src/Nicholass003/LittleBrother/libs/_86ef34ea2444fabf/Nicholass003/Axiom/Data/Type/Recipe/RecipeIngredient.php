<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Recipe;

final class RecipeIngredient{

    public function __construct(
        public readonly ?ItemDescriptor $descriptor,
        public readonly int $count
    ){}
}