<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class SetPlayerGameTypePacket implements Packet{

    public const ID = PacketIds::SET_PLAYER_GAME_TYPE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $gamemode;
}