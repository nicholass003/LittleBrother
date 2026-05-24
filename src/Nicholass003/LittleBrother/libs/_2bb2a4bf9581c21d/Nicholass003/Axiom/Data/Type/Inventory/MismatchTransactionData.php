<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory;

final class MismatchTransactionData implements TransactionData{

    /** @var list<NetworkInventoryAction> */
    public readonly array $actions;

    public function __construct(){
        $this->actions = [];
    }
}