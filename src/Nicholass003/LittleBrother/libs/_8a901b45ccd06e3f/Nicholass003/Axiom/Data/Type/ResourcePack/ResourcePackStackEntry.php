<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\ResourcePack;

class ResourcePackStackEntry{

    public function __construct(
        public readonly string $packId,
        public readonly string $version,
        public readonly string $subPackName
    ){}
}