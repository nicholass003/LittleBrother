<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type;

class ItemTypeEntry{

    public function __construct(
        public readonly string $stringId,
        public readonly int $numericId,
        public readonly bool $componentBased,
        public readonly int $version,
        public readonly string $componentNbt
    ){}
}