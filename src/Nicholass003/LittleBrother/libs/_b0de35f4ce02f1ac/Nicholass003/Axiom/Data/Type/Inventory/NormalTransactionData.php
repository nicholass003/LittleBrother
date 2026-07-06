<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Inventory;

final class NormalTransactionData implements TransactionData{

    /**
     * @param list<NetworkInventoryAction> $actions
     */
    public function __construct(
        public readonly array $actions
    ){}
}