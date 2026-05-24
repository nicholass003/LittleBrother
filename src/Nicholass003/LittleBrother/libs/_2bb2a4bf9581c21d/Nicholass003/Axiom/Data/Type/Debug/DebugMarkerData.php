<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Debug;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Vec3;

class DebugMarkerData{

    public function __construct(
        public readonly string $text,
        public readonly Vec3 $position,
        public readonly int $color,
        public readonly int $durationMillis
    ){}
}