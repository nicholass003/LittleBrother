<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class GuiDataPickItemPacket implements Packet{

    public const ID = PacketIds::GUI_DATA_PICK_ITEM;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $itemDescription;
    public string $itemEffects;
    public int $hotbarSlot;
}