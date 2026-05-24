<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

class ItemStackWrapper{

    public readonly int $stackIdVariant;

    public function __construct(
        public readonly int $stackId,
        public readonly ItemStack $itemStack,
        int $stackIdVariant = 0
    ){
        $this->stackIdVariant = $stackIdVariant;
    }
}