<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Command;

class CommandEnumRawData{

    /** @param list<int> $valueIndexes */
    public function __construct(
        public readonly string $name,
        public readonly array $valueIndexes,
    ){}
}