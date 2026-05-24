<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeScatterParamData{

    /**
     * @param list<BiomeCoordinateData> $coordinates
     */
    public function __construct(
        public readonly array $coordinates,
        public readonly int $evalOrder,
        public readonly int $chancePercentType,
        public readonly int $chancePercent,
        public readonly int $chanceNumerator,
        public readonly int $chanceDenominator,
        public readonly int $iterationsType,
        public readonly int $iterations,
    ){}
}