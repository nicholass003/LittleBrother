<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

class ItemTypeEntry{

    public function __construct(
        public readonly string $stringId,
        public readonly int $numericId,
        public readonly bool $componentBased,
        public readonly int $version,
        public readonly string $componentNbt
    ){}
}