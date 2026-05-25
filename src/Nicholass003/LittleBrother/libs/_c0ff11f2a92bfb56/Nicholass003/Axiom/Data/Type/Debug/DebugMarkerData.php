<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Debug;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Vec3;

class DebugMarkerData{

    public function __construct(
        public readonly string $text,
        public readonly Vec3 $position,
        public readonly int $color,
        public readonly int $durationMillis
    ){}
}