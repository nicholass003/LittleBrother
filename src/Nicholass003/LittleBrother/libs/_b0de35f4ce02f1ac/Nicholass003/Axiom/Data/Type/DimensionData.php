<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

final class DimensionData{

    public function __construct(
        public readonly int $maxHeight,
        public readonly int $minHeight,
        public readonly int $generator
    ){}
}