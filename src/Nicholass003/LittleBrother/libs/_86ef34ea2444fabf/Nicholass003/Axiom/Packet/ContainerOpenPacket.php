<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\BlockPosition;

class ContainerOpenPacket implements Packet{

    public const ID = PacketIds::CONTAINER_OPEN;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $windowId;
    public int $windowType;
    public BlockPosition $blockPosition;
    public int $actorUniqueId;
}