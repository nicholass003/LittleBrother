<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\BiomeReplacementData;

class BiomeDefinitionChunkGenData{

    /** 
     * @since v859
     * @var list<BiomeReplacementData> $replacementsData
     */
    public readonly ?array $replacementsData;

    public function __construct(
        public readonly ?BiomeClimateData $climate,
        public readonly ?BiomeConsolidatedFeaturesData $consolidatedFeatures,
        public readonly ?BiomeMountainParamsData $mountainParams,
        public readonly ?BiomeSurfaceMaterialAdjustmentData $surfaceMaterialAdjustment,
        public readonly ?BiomeSurfaceMaterialData $surfaceMaterial,
        public readonly bool $defaultOverworldSurface,
        public readonly bool $swampSurface,
        public readonly bool $frozenOceanSurface,
        public readonly bool $theEndSurface,
        public readonly ?BiomeMesaSurfaceData $mesaSurface,
        public readonly ?BiomeCappedSurfaceData $cappedSurface,
        public readonly ?BiomeOverworldGenRulesData $overworldGenRules,
        public readonly ?BiomeMultinoiseGenRulesData $multinoiseGenRules,
        public readonly ?BiomeLegacyWorldGenRulesData $legacyWorldGenRules,
        array $replacementsData = [],
    ){
        $this->replacementsData = $replacementsData;
    }
}