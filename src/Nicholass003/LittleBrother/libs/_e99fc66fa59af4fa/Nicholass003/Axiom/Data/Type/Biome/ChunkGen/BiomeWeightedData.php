<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeWeightedData{

    public function __construct(
        public readonly int $biome,
        public readonly int $weight,
    ){}
}