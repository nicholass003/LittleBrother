<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackResponseContainerInfo{

    /**
     * @param list<ItemStackResponseSlotInfo> $slots
     */
    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly array $slots
    ){}
}