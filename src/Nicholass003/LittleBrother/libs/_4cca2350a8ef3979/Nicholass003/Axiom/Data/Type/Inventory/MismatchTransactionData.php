<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory;

final class MismatchTransactionData implements TransactionData{

    /** @var list<NetworkInventoryAction> */
    public readonly array $actions;

    public function __construct(){
        $this->actions = [];
    }
}