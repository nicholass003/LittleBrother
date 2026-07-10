<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Armor\ArmorSlotAndDamagePair;

class PlayerArmorDamagePacket implements Packet{

    public const ID = PacketIds::PLAYER_ARMOR_DAMAGE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ArmorSlotAndDamagePair> */
    public array $armorSlotAndDamagePairs = [];
}