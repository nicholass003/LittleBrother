<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type;

final class DimensionData{

    public function __construct(
        public readonly int $maxHeight,
        public readonly int $minHeight,
        public readonly int $generator
    ){}
}