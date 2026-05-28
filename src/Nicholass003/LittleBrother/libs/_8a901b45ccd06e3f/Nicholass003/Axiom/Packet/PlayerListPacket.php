<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\PlayerListType;

class PlayerListPacket implements Packet{

    public const ID = PacketIds::PLAYER_LIST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public PlayerListType $type;

    public array $entries = [];
}