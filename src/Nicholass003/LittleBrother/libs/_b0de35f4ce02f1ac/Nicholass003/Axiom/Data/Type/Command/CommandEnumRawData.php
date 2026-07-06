<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Command;

class CommandEnumRawData{

    /** @param list<int> $valueIndexes */
    public function __construct(
        public readonly string $name,
        public readonly array $valueIndexes,
    ){}
}