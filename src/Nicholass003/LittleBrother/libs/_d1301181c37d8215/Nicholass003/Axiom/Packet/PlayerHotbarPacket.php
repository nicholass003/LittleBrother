<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\ContainerIds;

class PlayerHotbarPacket implements Packet{

    public const ID = PacketIds::PLAYER_HOTBAR;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $selectedHotbarSlot;
    public ContainerIds $windowId = ContainerIds::INVENTORY;
    public bool $selectHotbarSlot = true;
}