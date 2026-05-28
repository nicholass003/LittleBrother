<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CreativeCreateStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $creativeItemId,
        public readonly int $repetitions
    ){
        parent::__construct(ItemStackRequestActionType::CREATIVE_CREATE);
    }
}