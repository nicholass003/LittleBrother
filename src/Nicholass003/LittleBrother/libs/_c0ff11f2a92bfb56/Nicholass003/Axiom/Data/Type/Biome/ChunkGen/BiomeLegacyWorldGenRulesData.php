<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeLegacyWorldGenRulesData{

    /**
     * @param list<BiomeConditionalTransformationData> $legacyPreHills
     */
    public function __construct(
        public readonly array $legacyPreHills,
    ){}
}