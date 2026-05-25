<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

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