<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

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