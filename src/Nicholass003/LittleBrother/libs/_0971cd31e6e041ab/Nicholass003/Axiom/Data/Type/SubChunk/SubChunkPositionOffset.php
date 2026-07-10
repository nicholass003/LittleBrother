<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPositionOffset{

    public function __construct(
        public readonly int $xOffset,
        public readonly int $yOffset,
        public readonly int $zOffset
    ){}
}