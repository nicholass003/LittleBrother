<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\SubChunk;

class SubChunkPosition{

    public function __construct(
        public readonly int $x,
        public readonly int $y,
        public readonly int $z
    ){}
}