<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type;

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