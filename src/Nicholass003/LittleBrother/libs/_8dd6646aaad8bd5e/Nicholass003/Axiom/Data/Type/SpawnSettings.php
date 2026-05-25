<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

class SpawnSettings{

    public function __construct(
        public readonly int $biomeType,
        public readonly string $biomeName,
        public readonly int $dimension
    ){}
}