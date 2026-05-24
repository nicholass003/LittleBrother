<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ItemStackWrapper;

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