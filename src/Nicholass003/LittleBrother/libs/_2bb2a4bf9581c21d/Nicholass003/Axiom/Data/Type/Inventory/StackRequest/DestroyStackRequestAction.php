<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class DestroyStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $count,
        public readonly ItemStackRequestSlotInfo $source
    ){
        parent::__construct(ItemStackRequestActionType::DESTROY);
    }
}