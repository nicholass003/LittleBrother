<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMesaSurfaceData{

    public function __construct(
        public readonly int $clayMaterial,
        public readonly int $hardClayMaterial,
        public readonly bool $brycePillars,
        public readonly bool $forest,
    ){}
}