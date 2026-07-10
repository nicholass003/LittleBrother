<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeSurfaceMaterialData{

    public function __construct(
        public readonly int $topBlock,
        public readonly int $midBlock,
        public readonly int $seaFloorBlock,
        public readonly int $foundationBlock,
        public readonly int $seaBlock,
        public readonly int $seaFloorDepth
    ){}
}