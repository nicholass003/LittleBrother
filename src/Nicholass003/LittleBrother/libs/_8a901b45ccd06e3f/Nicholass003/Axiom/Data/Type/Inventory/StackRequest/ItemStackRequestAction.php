<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

abstract class ItemStackRequestAction{

    public function __construct(
        public readonly ItemStackRequestActionType $type
    ){}
}