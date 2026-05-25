<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\BlockPosition;

class BlockPickRequestPacket implements Packet{

    public const ID = PacketIds::BLOCK_PICK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BlockPosition $blockPosition;
    public bool $addUserData;
    public int $hotbarSlot;
}