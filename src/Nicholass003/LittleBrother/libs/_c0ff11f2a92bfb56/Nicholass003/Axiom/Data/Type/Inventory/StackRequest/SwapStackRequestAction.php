<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class SwapStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly ItemStackRequestSlotInfo $slot1,
        public readonly ItemStackRequestSlotInfo $slot2
    ){
        parent::__construct(ItemStackRequestActionType::SWAP);
    }
}