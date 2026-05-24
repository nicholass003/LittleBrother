<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Command;

class CommandEnumConstraintRawData{

    /** @param list<int> $constraints */
    public function __construct(
        public readonly int $affectedValueIndex,
        public readonly int $enumIndex,
        public readonly array $constraints,
    ){}
}