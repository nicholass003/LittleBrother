<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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