<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command;

class CommandEnumRawData{

    /** @param list<int> $valueIndexes */
    public function __construct(
        public readonly string $name,
        public readonly array $valueIndexes,
    ){}
}