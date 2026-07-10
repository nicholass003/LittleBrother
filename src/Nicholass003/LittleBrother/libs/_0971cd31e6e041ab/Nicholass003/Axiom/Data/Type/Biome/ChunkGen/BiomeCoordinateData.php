<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Biome\ChunkGen;

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