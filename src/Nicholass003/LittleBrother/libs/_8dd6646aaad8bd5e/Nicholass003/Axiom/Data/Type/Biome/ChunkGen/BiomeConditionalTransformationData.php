<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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