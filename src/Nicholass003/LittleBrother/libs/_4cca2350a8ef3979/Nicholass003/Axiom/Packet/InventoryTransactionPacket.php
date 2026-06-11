<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\InventoryTransactionChangedSlotsHack;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\TransactionData;

class InventoryTransactionPacket implements Packet{

    public const ID = PacketIds::INVENTORY_TRANSACTION;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $requestId;
    /** @var list<InventoryTransactionChangedSlotsHack> */
    public array $requestChangedSlots = [];
    /** @since v1001 */
    public bool $hasLegacySetSlots = false;
    /** @since v1001 */
    public bool $hasTransactionData = false;
    public TransactionData $trData;
}