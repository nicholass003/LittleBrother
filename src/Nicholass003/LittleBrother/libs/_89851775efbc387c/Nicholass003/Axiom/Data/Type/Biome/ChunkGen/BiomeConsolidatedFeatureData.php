<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeConsolidatedFeatureData{

    public function __construct(
        public readonly BiomeScatterParamData $scatter,
        public readonly int $feature,
        public readonly int $identifier,
        public readonly int $pass,
        public readonly bool $useInternal
    ){}
}