<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPosition;

class UpdateBlockPacket implements Packet{

    public const ID = PacketIds::UPDATE_BLOCK;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public BlockPosition $blockPosition;
    public int $blockRuntimeId;
    public int $flags;
    public int $dataLayerId;
}