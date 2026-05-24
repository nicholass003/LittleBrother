<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

class ItemStackRequest{

    /**
     * @param list<ItemStackRequestAction> $actions
     * @param list<string>                 $filterStrings
     */
    public function __construct(
        public readonly int $requestId,
        public readonly array $actions,
        public readonly array $filterStrings,
        public readonly int $filterStringCause
    ){}
}