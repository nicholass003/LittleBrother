<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Armor\ArmorSlotAndDamagePair;

class PlayerArmorDamagePacket implements Packet{

    public const ID = PacketIds::PLAYER_ARMOR_DAMAGE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ArmorSlotAndDamagePair> */
    public array $armorSlotAndDamagePairs = [];
}