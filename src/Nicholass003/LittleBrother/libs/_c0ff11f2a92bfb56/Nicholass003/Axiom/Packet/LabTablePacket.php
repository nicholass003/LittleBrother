<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\LabTableActionType;

class LabTablePacket implements Packet{

    public const ID = PacketIds::LAB_TABLE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public LabTableActionType $actionType;
    public BlockPosition $blockPosition;
    public int $reactionType;
}