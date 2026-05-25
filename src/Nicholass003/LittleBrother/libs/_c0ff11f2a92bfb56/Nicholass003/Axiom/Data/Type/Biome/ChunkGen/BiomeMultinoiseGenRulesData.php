<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMultinoiseGenRulesData{

    public function __construct(
        public readonly float $temperature,
        public readonly float $humidity,
        public readonly float $altitude,
        public readonly float $weirdness,
        public readonly float $weight,
    ){}
}