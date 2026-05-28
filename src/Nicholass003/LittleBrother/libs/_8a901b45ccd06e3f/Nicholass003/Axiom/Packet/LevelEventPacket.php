<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\LevelEventType;

class LevelEventPacket implements Packet{

    public const ID = PacketIds::LEVEL_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public LevelEventType $eventId;
    public int $eventData;
    public ?Vec3 $position = null;
}