<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ItemStackWrapper;

class InventorySlotPacket implements Packet{

    public const ID = PacketIds::INVENTORY_SLOT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $windowId;
    public int $inventorySlot;
    /** @since v975 (optional, nullable) - previously required */
    public ?FullContainerName $containerName = null;
    /** @since v975 (optional, nullable) - previously required */
    public ?ItemStackWrapper $storage = null;
    public ItemStackWrapper $item;
}