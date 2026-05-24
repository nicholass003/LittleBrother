<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeDefinitionChunkGenData;

class BiomeDefinitionData{

    /**
     * @param list<int>|null $tagIndexes
     */
    public function __construct(
        public readonly int $nameIndex,
        public readonly int $id,
        public readonly float $temperature,
        public readonly float $downfall,
        public readonly float $foliageSnow,
        public readonly float $depth,
        public readonly float $scale,
        public readonly int $mapWaterColor, // ARGB
        public readonly bool $hasRain,
        public readonly ?array $tagIndexes,
        public readonly ?BiomeDefinitionChunkGenData $chunkGenData
    ){}
}