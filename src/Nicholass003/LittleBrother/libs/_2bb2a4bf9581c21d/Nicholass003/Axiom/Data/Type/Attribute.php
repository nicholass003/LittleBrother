<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

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