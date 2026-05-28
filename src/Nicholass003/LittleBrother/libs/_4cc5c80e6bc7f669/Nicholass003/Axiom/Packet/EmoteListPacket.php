<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class EmoteListPacket implements Packet{

    public const ID = PacketIds::EMOTE_LIST;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $playerActorRuntimeId;
    /** @var list<string> */
    public array $emoteIds = [];
}