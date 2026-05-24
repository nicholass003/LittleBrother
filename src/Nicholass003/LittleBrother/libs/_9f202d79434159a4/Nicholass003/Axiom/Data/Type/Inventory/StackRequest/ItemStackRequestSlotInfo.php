<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackRequestSlotInfo{

    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly int $slotId,
        public readonly int $stackId
    ){}
}