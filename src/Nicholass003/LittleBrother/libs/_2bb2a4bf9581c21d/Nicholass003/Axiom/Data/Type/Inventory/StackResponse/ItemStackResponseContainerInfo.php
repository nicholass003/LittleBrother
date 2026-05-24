<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackResponseContainerInfo{

    /**
     * @param list<ItemStackResponseSlotInfo> $slots
     */
    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly array $slots
    ){}
}