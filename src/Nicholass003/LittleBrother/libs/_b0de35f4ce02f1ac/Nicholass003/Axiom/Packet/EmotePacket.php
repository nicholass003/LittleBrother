<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\EmoteFlags;

class EmotePacket implements Packet{

    public const ID = PacketIds::EMOTE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorRuntimeId;
    public string $emoteId;
    public int $emoteLengthTicks;
    public string $xboxUserId;
    public string $platformChatId;
    public EmoteFlags $flags;
}