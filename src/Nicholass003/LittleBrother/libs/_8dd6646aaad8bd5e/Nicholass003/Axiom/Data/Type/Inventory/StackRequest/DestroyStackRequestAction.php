<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class DestroyStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly int $count,
        public readonly ItemStackRequestSlotInfo $source
    ){
        parent::__construct(ItemStackRequestActionType::DESTROY);
    }
}