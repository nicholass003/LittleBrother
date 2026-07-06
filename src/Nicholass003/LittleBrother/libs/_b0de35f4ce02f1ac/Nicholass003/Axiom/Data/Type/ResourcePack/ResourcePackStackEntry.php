<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\ResourcePack;

class ResourcePackStackEntry{

    public function __construct(
        public readonly string $packId,
        public readonly string $version,
        public readonly string $subPackName
    ){}
}