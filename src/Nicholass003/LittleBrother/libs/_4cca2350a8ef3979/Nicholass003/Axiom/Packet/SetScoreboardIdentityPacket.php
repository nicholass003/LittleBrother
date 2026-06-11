<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Score\ScoreboardIdentityPacketEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\SetScoreboardIdentityType;

class SetScoreboardIdentityPacket implements Packet{

    public const ID = PacketIds::SET_SCOREBOARD_IDENTITY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public SetScoreboardIdentityType $type;
    /** @var list<ScoreboardIdentityPacketEntry> */
    public array $entries = [];
}