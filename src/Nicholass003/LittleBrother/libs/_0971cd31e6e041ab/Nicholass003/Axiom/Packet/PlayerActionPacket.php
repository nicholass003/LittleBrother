<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\BlockPosition;

class PlayerActionPacket implements Packet{

    public const ID = PacketIds::PLAYER_ACTION;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorRuntimeId;
    public int $action;
    public BlockPosition $blockPosition;
    public BlockPosition $resultPosition;
    public int $face;
}