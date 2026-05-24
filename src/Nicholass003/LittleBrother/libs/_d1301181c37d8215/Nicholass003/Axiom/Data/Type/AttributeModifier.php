<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type;

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