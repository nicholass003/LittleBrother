<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Command;

class CommandOverloadRawData{

    /** @param list<CommandParameterRawData> $parameters */
    public function __construct(
        public readonly bool $chaining,
        public readonly array $parameters,
    ){}
}