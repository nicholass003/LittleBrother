<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeClimateData{

    public function __construct(
        public readonly float $temperature,
        public readonly float $downfall,
        public readonly float $snowAccumulationMin,
        public readonly float $snowAccumulationMax,
    ){}
}