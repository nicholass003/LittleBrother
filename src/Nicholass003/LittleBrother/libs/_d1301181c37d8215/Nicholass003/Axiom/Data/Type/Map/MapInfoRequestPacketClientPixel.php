<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Map;

class MapInfoRequestPacketClientPixel{

    public function __construct(
        public readonly int $colorRgba,
        public readonly int $x,
        public readonly int $y
    ){}
}