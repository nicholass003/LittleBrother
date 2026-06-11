<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Vec3;

class ServerPlayerPostMovePositionPacket implements Packet{

    public const ID = PacketIds::SERVER_PLAYER_POST_MOVE_POSITION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public Vec3 $position;
}