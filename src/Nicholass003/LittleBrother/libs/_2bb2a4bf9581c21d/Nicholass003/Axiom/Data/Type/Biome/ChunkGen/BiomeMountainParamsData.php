<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMountainParamsData{

    public function __construct(
        public readonly int $steepBlock,
        public readonly bool $northSlopes,
        public readonly bool $southSlopes,
        public readonly bool $westSlopes,
        public readonly bool $eastSlopes,
        public readonly bool $topSlideEnabled,
    ){}
}