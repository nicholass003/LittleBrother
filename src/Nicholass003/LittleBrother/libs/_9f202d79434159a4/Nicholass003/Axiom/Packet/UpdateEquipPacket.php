<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

class UpdateEquipPacket implements Packet{

    public const ID = PacketIds::UPDATE_EQUIP;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $windowId;
    public int $windowType;
    public int $windowSlotCount;
    public int $actorUniqueId;
    public string $nbt; // Raw NBT binary data
}