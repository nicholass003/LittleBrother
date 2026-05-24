<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class UpdateBlockPacket implements Packet{

    public const ID = PacketIds::UPDATE_BLOCK;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public BlockPosition $blockPosition;
    public int $blockRuntimeId;
    public int $flags;
    public int $dataLayerId;
}