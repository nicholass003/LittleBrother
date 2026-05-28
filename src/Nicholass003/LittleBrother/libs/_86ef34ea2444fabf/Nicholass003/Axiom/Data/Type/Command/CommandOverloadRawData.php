<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Command;

class CommandOverloadRawData{

    /** @param list<CommandParameterRawData> $parameters */
    public function __construct(
        public readonly bool $chaining,
        public readonly array $parameters,
    ){}
}