<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type;

class SpawnSettings{

    public function __construct(
        public readonly int $biomeType,
        public readonly string $biomeName,
        public readonly int $dimension
    ){}
}