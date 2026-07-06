<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

class ItemTypeEntry{

    public function __construct(
        public readonly string $stringId,
        public readonly int $numericId,
        public readonly bool $componentBased,
        public readonly int $version,
        public readonly string $componentNbt
    ){}
}