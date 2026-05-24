<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeElementData{

    public function __construct(
        public readonly float $noiseFrequencyScale,
        public readonly float $noiseLowerBound,
        public readonly float $noiseUpperBound,
        public readonly int $heightMinType,
        public readonly int $heightMin,
        public readonly int $heightMaxType,
        public readonly int $heightMax,
        public readonly BiomeSurfaceMaterialData $surfaceMaterial,
    ){}
}