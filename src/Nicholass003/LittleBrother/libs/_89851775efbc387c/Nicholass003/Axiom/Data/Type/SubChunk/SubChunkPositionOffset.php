<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPositionOffset{

    public function __construct(
        public readonly int $xOffset,
        public readonly int $yOffset,
        public readonly int $zOffset
    ){}
}