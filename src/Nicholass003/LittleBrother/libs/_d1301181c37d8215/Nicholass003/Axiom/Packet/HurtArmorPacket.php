<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\ArmorSlot;

class HurtArmorPacket implements Packet{

    public const ID = PacketIds::HURT_ARMOR;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $cause;
    public int $health;
    public ArmorSlot $armorSlotFlags;
}