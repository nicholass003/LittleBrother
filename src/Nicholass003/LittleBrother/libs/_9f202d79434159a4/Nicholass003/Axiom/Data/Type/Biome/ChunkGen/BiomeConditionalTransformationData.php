<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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