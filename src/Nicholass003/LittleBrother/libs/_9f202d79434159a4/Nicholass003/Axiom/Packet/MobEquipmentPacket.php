<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\ItemStackWrapper;

class MobEquipmentPacket implements Packet{

    public const ID = PacketIds::MOB_EQUIPMENT;
    public const RECIPIENT = PacketRecipient::BOTH;

	public int $actorRuntimeId;
	public ItemStackWrapper $item;
	public int $inventorySlot;
	public int $hotbarSlot;
	public int $windowId = 0;
}