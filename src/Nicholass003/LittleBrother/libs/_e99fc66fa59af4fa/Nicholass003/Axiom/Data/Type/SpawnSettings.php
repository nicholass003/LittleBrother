<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type;

class SpawnSettings{

    public function __construct(
        public readonly int $biomeType,
        public readonly string $biomeName,
        public readonly int $dimension
    ){}
}