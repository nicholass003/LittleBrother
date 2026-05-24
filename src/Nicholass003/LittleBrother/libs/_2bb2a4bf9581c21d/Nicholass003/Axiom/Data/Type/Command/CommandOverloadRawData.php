<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Command;

class CommandOverloadRawData{

    /** @param list<CommandParameterRawData> $parameters */
    public function __construct(
        public readonly bool $chaining,
        public readonly array $parameters,
    ){}
}