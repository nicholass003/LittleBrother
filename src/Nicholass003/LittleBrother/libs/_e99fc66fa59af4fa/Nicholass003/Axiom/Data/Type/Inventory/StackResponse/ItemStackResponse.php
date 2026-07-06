<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Inventory\StackResponse;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ItemStackResponseResult;

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