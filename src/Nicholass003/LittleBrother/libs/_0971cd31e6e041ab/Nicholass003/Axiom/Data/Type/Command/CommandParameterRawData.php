<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Command;

class CommandParameterRawData{

    public function __construct(
        public readonly string $name,
        public readonly int $typeInfo,
        public readonly bool $optional,
        public readonly int $flags,
    ){}
}