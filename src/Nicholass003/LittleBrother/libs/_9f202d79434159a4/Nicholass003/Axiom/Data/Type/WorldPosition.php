<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type;

class WorldPosition{

    public function __construct(
        public readonly Vec3 $position,
        public readonly int $dimension
    ){}
}