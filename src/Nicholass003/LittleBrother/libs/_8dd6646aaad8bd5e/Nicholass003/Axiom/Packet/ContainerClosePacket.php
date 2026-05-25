<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class ContainerClosePacket implements Packet{

    public const ID = PacketIds::CONTAINER_CLOSE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $windowId;
    public int $windowType;
    public bool $server = false;
}