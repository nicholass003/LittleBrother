<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Trim;

class TrimMaterial{

    public function __construct(
        public readonly string $materialId,
        public readonly string $color,
        public readonly string $itemId
    ){}
}