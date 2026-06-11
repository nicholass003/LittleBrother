<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

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