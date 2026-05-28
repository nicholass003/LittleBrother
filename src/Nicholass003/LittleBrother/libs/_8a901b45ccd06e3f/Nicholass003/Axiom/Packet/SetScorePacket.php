<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Score\ScorePacketEntry;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\SetScorePacketType;

class SetScorePacket implements Packet{

    public const ID = PacketIds::SET_SCORE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public SetScorePacketType $type;
    /** @var list<ScorePacketEntry> */
    public array $entries = [];
}