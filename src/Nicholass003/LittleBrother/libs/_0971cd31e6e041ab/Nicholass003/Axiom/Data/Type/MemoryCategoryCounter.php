<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\MemoryCategory;

class MemoryCategoryCounter{

    public function __construct(
        public readonly MemoryCategory $category,
        public readonly int $bytes
    ){}
}