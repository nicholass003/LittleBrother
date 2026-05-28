<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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