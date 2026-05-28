<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Map;

class MapInfoRequestPacketClientPixel{

    public function __construct(
        public readonly int $colorRgba,
        public readonly int $x,
        public readonly int $y
    ){}
}