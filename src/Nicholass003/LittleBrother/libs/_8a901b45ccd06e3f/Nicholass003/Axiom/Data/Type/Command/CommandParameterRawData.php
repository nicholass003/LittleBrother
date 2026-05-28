<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Command;

class CommandParameterRawData{

    public function __construct(
        public readonly string $name,
        public readonly int $typeInfo,
        public readonly bool $optional,
        public readonly int $flags,
    ){}
}