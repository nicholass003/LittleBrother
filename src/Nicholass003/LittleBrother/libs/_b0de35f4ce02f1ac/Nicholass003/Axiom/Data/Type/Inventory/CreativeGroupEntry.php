<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\ItemStack;

final class CreativeGroupEntry{

    public function __construct(
        public readonly int $categoryId,
        public readonly string $categoryName,
        public readonly ItemStack $icon
    ){}
}