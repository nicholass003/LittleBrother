<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Inventory;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\ItemStack;

final class CreativeItemEntry{

    public function __construct(
        public readonly int $entryId,
        public readonly ItemStack $item,
        public readonly int $groupId
    ){}
}