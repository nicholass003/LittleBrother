<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Command;

class CommandSoftEnum{

    /** @param list<string> $values */
    public function __construct(
        public readonly string $name,
        public readonly array $values,
    ){}
}