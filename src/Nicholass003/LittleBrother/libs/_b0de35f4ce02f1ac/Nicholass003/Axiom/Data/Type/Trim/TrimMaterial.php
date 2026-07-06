<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Trim;

class TrimMaterial{

    public function __construct(
        public readonly string $materialId,
        public readonly string $color,
        public readonly string $itemId
    ){}
}