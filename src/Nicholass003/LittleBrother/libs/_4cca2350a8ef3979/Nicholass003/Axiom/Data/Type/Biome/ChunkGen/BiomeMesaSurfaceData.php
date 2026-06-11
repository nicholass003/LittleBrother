<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMesaSurfaceData{

    public function __construct(
        public readonly int $clayMaterial,
        public readonly int $hardClayMaterial,
        public readonly bool $brycePillars,
        public readonly bool $forest,
    ){}
}