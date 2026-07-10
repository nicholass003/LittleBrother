<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeCappedSurfaceData{

    /**
     * @param list<int> $floorBlocks
     * @param list<int> $ceilingBlocks
     */
    public function __construct(
        public readonly array $floorBlocks,
        public readonly array $ceilingBlocks,
        public readonly ?int $seaBlock,
        public readonly ?int $foundationBlock,
        public readonly ?int $beachBlock,
    ){}
}