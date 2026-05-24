<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class SetSpawnPositionPacket implements Packet{

    public const ID = PacketIds::SET_SPAWN_POSITION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $spawnType;
    public BlockPosition $spawnPosition;
    public int $dimension;
    public BlockPosition $causingBlockPosition;
}