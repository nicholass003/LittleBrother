<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Vec3;

class ServerPlayerPostMovePositionPacket implements Packet{

    public const ID = PacketIds::SERVER_PLAYER_POST_MOVE_POSITION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public Vec3 $position;
}