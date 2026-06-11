<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Score\ScorePacketEntry;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\SetScorePacketType;

class SetScorePacket implements Packet{

    public const ID = PacketIds::SET_SCORE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public SetScorePacketType $type;
    /** @var list<ScorePacketEntry> */
    public array $entries = [];
}