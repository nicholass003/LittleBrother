<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class LoomStackRequestAction extends ItemStackRequestAction{

    public function __construct(
        public readonly string $patternId,
        public readonly int $repetitions = 1
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_LOOM);
    }
}