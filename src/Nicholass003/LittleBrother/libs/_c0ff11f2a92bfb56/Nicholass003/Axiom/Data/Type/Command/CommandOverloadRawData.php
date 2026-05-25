<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Command;

class CommandOverloadRawData{

    /** @param list<CommandParameterRawData> $parameters */
    public function __construct(
        public readonly bool $chaining,
        public readonly array $parameters,
    ){}
}