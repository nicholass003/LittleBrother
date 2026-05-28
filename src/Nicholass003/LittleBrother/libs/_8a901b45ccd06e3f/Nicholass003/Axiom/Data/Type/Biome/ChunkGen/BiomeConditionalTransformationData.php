<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeConditionalTransformationData{

    /**
     * @param list<BiomeWeightedData> $weightedBiomes
     */
    public function __construct(
        public readonly array $weightedBiomes,
        public readonly int $conditionJSON,
        public readonly int $minPassingNeighbors,
    ){}
}