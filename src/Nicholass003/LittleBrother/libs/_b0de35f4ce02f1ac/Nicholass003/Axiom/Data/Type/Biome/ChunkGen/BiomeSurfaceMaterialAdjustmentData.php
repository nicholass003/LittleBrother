<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeSurfaceMaterialAdjustmentData{

    /**
     * @param list<BiomeElementData> $adjustments
     */
    public function __construct(
        public readonly array $adjustments,
    ){}
}