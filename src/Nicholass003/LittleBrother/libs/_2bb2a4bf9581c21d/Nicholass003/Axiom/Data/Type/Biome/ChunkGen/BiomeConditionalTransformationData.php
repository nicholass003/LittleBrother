<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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