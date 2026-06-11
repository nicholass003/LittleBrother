<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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