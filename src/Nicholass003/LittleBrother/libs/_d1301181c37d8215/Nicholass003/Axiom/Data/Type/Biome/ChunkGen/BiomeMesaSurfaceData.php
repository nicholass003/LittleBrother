<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeMesaSurfaceData{

    public function __construct(
        public readonly int $clayMaterial,
        public readonly int $hardClayMaterial,
        public readonly bool $brycePillars,
        public readonly bool $forest,
    ){}
}