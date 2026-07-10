<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory;

final class MismatchTransactionData implements TransactionData{

    /** @var list<NetworkInventoryAction> */
    public readonly array $actions;

    public function __construct(){
        $this->actions = [];
    }
}