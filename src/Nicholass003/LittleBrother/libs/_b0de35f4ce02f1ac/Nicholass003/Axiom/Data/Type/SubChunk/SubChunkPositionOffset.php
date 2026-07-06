<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPositionOffset{

    public function __construct(
        public readonly int $xOffset,
        public readonly int $yOffset,
        public readonly int $zOffset
    ){}
}