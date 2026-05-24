<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMultinoiseGenRulesData{

    public function __construct(
        public readonly float $temperature,
        public readonly float $humidity,
        public readonly float $altitude,
        public readonly float $weirdness,
        public readonly float $weight,
    ){}
}