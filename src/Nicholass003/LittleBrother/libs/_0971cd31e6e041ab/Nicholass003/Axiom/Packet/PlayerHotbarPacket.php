<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ContainerIds;

class PlayerHotbarPacket implements Packet{

    public const ID = PacketIds::PLAYER_HOTBAR;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $selectedHotbarSlot;
    public ContainerIds $windowId = ContainerIds::INVENTORY;
    public bool $selectHotbarSlot = true;
}