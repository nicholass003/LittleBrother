<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackRequestSlotInfo{

    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly int $slotId,
        public readonly int $stackId
    ){}
}