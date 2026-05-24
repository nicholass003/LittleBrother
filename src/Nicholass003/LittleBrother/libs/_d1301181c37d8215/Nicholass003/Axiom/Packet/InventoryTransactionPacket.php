<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Inventory\TransactionData;

class InventoryTransactionPacket implements Packet{

    public const ID = PacketIds::INVENTORY_TRANSACTION;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $requestId;
    /** @var list<InventoryTransactionChangedSlotsHack> */
    public array $requestChangedSlots = [];
    public TransactionData $trData;
}