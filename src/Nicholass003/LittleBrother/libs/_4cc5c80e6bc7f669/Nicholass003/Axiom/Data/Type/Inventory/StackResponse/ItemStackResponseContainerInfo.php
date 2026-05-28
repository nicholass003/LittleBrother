<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackResponseContainerInfo{

    /**
     * @param list<ItemStackResponseSlotInfo> $slots
     */
    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly array $slots
    ){}
}