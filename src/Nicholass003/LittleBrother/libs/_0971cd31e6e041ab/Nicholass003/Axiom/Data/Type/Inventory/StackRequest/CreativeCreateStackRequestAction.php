<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CreativeCreateStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $creativeItemId,
        public readonly int $repetitions
    ){
        parent::__construct(ItemStackRequestActionType::CREATIVE_CREATE);
    }
}