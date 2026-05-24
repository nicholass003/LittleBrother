<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ItemStack;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class DeprecatedCraftingResultsStackRequestAction extends ItemStackRequestAction{

    /**
     * @param list<ItemStack> $results
     */
    public function __construct(
        public readonly array $results,
        public readonly int $iterations
    ){
        parent::__construct(ItemStackRequestActionType::CRAFTING_RESULTS_DEPRECATED_ASK_TY_LAING);
    }
}