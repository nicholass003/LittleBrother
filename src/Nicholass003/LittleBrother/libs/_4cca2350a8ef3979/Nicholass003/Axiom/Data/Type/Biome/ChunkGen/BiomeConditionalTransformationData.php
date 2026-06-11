<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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