<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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