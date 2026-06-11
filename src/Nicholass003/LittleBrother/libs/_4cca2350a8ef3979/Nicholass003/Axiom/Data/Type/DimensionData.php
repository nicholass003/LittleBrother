<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type;

final class DimensionData{

    public function __construct(
        public readonly int $maxHeight,
        public readonly int $minHeight,
        public readonly int $generator
    ){}
}