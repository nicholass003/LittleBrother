<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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