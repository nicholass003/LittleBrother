<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPositionOffset{

    public function __construct(
        public readonly int $xOffset,
        public readonly int $yOffset,
        public readonly int $zOffset
    ){}
}