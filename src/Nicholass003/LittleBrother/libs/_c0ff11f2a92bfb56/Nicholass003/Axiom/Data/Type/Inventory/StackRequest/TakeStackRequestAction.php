<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class TakeStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $count,
        public readonly ItemStackRequestSlotInfo $source,
        public readonly ItemStackRequestSlotInfo $destination
    ){
        parent::__construct(ItemStackRequestActionType::TAKE);
    }
}