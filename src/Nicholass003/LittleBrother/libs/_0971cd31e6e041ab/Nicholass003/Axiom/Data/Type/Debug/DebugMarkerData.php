<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Debug;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class DebugMarkerData{

    public function __construct(
        public readonly string $text,
        public readonly Vec3 $position,
        public readonly int $color,
        public readonly int $durationMillis
    ){}
}