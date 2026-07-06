<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

class Attribute{

    /**
     * @param AttributeModifier[] $modifiers
     */
    public function __construct(
        public readonly string $id,
        public readonly float $min,
        public readonly float $max,
        public readonly float $current,
        public readonly float $default,
        public readonly array $modifiers = []
    ){}
}