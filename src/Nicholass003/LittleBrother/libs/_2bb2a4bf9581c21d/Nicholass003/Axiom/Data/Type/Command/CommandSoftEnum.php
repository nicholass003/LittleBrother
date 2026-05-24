<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Command;

class CommandSoftEnum{

    /** @param list<string> $values */
    public function __construct(
        public readonly string $name,
        public readonly array $values,
    ){}
}