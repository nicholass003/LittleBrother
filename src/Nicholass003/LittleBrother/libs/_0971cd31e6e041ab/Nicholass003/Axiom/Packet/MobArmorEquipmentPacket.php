<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\ItemStackWrapper;

class MobArmorEquipmentPacket implements Packet{

    public const ID = PacketIds::MOB_ARMOR_EQUIPMENT;
    public const RECIPIENT = PacketRecipient::BOTH;

	public int $actorRuntimeId;

	public ItemStackWrapper $head;
	public ItemStackWrapper $chest;
	public ItemStackWrapper $legs;
	public ItemStackWrapper $feet;
	public ItemStackWrapper $body;
}