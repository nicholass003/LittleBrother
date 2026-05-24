<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\ItemStackResponseResult;

class ItemStackResponse{

    /**
     * @param list<ItemStackResponseContainerInfo> $containerInfos
     */
    public function __construct(
        public readonly ItemStackResponseResult $result,
        public readonly int $requestId,
        public readonly array $containerInfos = []
    ){}
}