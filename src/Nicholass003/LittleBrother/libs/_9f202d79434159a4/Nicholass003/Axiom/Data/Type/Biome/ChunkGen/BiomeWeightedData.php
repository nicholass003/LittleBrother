<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeWeightedData{

    public function __construct(
        public readonly int $biome,
        public readonly int $weight,
    ){}
}