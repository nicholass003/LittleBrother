<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\LevelEventType;

class LevelEventPacket implements Packet{

    public const ID = PacketIds::LEVEL_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public LevelEventType $eventId;
    public int $eventData;
    public ?Vec3 $position = null;
}