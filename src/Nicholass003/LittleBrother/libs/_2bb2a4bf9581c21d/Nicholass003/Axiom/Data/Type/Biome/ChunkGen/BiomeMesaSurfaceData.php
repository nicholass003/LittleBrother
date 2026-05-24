<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMesaSurfaceData{

    public function __construct(
        public readonly int $clayMaterial,
        public readonly int $hardClayMaterial,
        public readonly bool $brycePillars,
        public readonly bool $forest,
    ){}
}