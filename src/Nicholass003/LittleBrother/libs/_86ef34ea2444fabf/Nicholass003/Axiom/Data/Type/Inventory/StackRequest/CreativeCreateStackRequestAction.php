<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CreativeCreateStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $creativeItemId,
        public readonly int $repetitions
    ){
        parent::__construct(ItemStackRequestActionType::CREATIVE_CREATE);
    }
}