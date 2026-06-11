<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\ItemStackWrapper;

class InventoryContentPacket implements Packet{

    public const ID = PacketIds::INVENTORY_CONTENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $windowId;
    /** @var list<ItemStackWrapper> */
    public array $items = [];
    public FullContainerName $containerName;
    public ItemStackWrapper $storage;
}