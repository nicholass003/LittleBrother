<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeDefinitionChunkGenData;

class BiomeDefinitionEntry{

    /**
     * @param list<string>|null $tags
     */
    public function __construct(
        public readonly string $biomeName,
        public readonly int $id,
        public readonly float $temperature,
        public readonly float $downfall,
        public readonly float $foliageSnow,
        public readonly float $depth,
        public readonly float $scale,
        public readonly int $mapWaterColor,
        public readonly bool $hasRain,
        public readonly ?array $tags,
        public readonly ?BiomeDefinitionChunkGenData $chunkGenData
    ){}
}