<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Trim;

class TrimMaterial{

    public function __construct(
        public readonly string $materialId,
        public readonly string $color,
        public readonly string $itemId
    ){}
}