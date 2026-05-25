<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPosition;

class BlockPickRequestPacket implements Packet{

    public const ID = PacketIds::BLOCK_PICK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BlockPosition $blockPosition;
    public bool $addUserData;
    public int $hotbarSlot;
}