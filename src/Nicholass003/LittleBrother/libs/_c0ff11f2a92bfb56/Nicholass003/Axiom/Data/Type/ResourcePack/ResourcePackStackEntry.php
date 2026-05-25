<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\ResourcePack;

class ResourcePackStackEntry{

    public function __construct(
        public readonly string $packId,
        public readonly string $version,
        public readonly string $subPackName
    ){}
}