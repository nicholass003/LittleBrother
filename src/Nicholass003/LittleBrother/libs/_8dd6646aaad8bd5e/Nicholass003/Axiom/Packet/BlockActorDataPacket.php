<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\BlockPosition;

class BlockActorDataPacket implements Packet{

    public const ID = PacketIds::BLOCK_ACTOR_DATA;
    public const RECIPIENT = PacketRecipient::BOTH;

    public BlockPosition $blockPosition;
    public string $nbtData; // binary NBT compound
}