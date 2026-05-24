<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class BlockEventPacket implements Packet{

    public const ID = PacketIds::BLOCK_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public BlockPosition $blockPosition;
    public int $eventType;
    public int $eventData;
}