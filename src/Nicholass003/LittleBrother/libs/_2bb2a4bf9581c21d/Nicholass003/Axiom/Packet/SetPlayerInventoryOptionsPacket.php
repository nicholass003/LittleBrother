<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\InventoryLayout;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\InventoryLeftTab;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\InventoryRightTab;

class SetPlayerInventoryOptionsPacket implements Packet{

    public const ID = PacketIds::SET_PLAYER_INVENTORY_OPTIONS;
    public const RECIPIENT = PacketRecipient::BOTH;

    public InventoryLeftTab $leftTab;
    public InventoryRightTab $rightTab;
    public bool $filtering;
    public InventoryLayout $inventoryLayout;
    public InventoryLayout $craftingLayout;
}