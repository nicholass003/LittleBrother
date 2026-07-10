<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class SwapStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly ItemStackRequestSlotInfo $slot1,
        public readonly ItemStackRequestSlotInfo $slot2
    ){
        parent::__construct(ItemStackRequestActionType::SWAP);
    }
}