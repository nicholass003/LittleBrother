<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Map;

class MapDecoration{

    public function __construct(
        public readonly int $icon,
        public readonly int $rotation,
        public readonly int $xOffset,
        public readonly int $yOffset,
        public readonly string $label,
        public readonly int $colorRgba
    ){}
}