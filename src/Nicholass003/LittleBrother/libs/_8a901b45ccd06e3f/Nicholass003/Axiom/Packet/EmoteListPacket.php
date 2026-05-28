<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class EmoteListPacket implements Packet{

    public const ID = PacketIds::EMOTE_LIST;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $playerActorRuntimeId;
    /** @var list<string> */
    public array $emoteIds = [];
}