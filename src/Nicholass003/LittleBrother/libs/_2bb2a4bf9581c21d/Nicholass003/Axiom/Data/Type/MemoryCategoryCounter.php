<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\MemoryCategory;

class MemoryCategoryCounter{

    public function __construct(
        public readonly MemoryCategory $category,
        public readonly int $bytes
    ){}
}