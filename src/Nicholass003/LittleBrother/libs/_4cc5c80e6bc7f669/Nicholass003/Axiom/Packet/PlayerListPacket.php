<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\PlayerListType;

class PlayerListPacket implements Packet{

    public const ID = PacketIds::PLAYER_LIST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public PlayerListType $type;

    public array $entries = [];
}