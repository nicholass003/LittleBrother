<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class AttributeModifier{

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly float $amount,
        public readonly int $operation,
        public readonly int $operand,
        public readonly bool $serializable
    ){}
}