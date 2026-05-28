<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Recipe;

final class RecipeIngredient{

    public function __construct(
        public readonly ?ItemDescriptor $descriptor,
        public readonly int $count
    ){}
}