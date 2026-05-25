<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\ResourcePack;

class ResourcePackStackEntry{

    public function __construct(
        public readonly string $packId,
        public readonly string $version,
        public readonly string $subPackName
    ){}
}