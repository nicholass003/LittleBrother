<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;

class ItemStackRequestSlotInfo{

    public function __construct(
        public readonly FullContainerName $containerName,
        public readonly int $slotId,
        public readonly int $stackId
    ){}
}