<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeLegacyWorldGenRulesData{

    /**
     * @param list<BiomeConditionalTransformationData> $legacyPreHills
     */
    public function __construct(
        public readonly array $legacyPreHills,
    ){}
}