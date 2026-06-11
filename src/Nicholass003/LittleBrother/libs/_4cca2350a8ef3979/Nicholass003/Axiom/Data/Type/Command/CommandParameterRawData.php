<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Command;

class CommandParameterRawData{

    public function __construct(
        public readonly string $name,
        public readonly int $typeInfo,
        public readonly bool $optional,
        public readonly int $flags,
    ){}
}