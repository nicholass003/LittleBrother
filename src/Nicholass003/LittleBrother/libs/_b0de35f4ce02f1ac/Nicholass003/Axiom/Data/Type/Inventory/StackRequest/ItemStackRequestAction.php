<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

abstract class ItemStackRequestAction{

    public function __construct(
        public readonly ItemStackRequestActionType $type
    ){}
}