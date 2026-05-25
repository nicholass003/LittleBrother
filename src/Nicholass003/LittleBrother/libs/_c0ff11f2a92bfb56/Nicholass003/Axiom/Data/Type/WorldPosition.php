<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

class WorldPosition{

    public function __construct(
        public readonly Vec3 $position,
        public readonly int $dimension
    ){}
}