<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeOverworldGenRulesData{

    /**
     * @param list<BiomeWeightedData> $hillTransformations
     * @param list<BiomeWeightedData> $mutateTransformations
     * @param list<BiomeWeightedData> $riverTransformations
     * @param list<BiomeWeightedData> $shoreTransformations
     * @param list<BiomeConditionalTransformationData> $preHillsEdges
     * @param list<BiomeConditionalTransformationData> $postShoreEdges
     * @param list<BiomeWeightedTemperatureData> $climates
     */
    public function __construct(
        public readonly array $hillTransformations,
        public readonly array $mutateTransformations,
        public readonly array $riverTransformations,
        public readonly array $shoreTransformations,
        public readonly array $preHillsEdges,
        public readonly array $postShoreEdges,
        public readonly array $climates,
    ){}
}