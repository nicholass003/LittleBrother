<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\PlayerLocationType;

class PlayerLocationPacket implements Packet{

    public const ID = PacketIds::PLAYER_LOCATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public PlayerLocationType $type;
    public int $actorUniqueId;
    public ?Vec3 $position = null;
}