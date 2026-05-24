<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory;

final class MismatchTransactionData implements TransactionData{

    /** @var list<NetworkInventoryAction> */
    public readonly array $actions;

    public function __construct(){
        $this->actions = [];
    }
}