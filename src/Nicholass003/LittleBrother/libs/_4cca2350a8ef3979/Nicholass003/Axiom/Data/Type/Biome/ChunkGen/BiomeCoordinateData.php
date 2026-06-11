<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

class BiomeCoordinateData{

    public function __construct(
        public readonly int $minValueType,
        public readonly int $minValue,
        public readonly int $maxValueType,
        public readonly int $maxValue,
        public readonly int $gridOffset,
        public readonly int $gridStepSize,
        public readonly int $distribution
    ){}
}