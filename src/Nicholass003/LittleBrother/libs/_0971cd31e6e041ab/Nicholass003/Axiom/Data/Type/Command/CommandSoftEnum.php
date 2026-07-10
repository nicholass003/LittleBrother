<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Command;

class CommandSoftEnum{

    /** @param list<string> $values */
    public function __construct(
        public readonly string $name,
        public readonly array $values,
    ){}
}