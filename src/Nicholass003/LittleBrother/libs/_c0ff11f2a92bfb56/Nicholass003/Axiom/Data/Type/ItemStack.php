<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

class ItemStack{

    public function __construct(
        public readonly int $id,
        public readonly int $meta,
        public readonly int $count,
        public readonly int $blockRuntimeId,
        public readonly string $rawExtraData
    ){}
}