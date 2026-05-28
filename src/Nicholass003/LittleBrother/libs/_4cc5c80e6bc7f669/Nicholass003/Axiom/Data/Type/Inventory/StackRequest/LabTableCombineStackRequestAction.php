<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class LabTableCombineStackRequestAction extends ItemStackRequestAction{

    public function __construct(){
        parent::__construct(ItemStackRequestActionType::LAB_TABLE_COMBINE);
    }
}