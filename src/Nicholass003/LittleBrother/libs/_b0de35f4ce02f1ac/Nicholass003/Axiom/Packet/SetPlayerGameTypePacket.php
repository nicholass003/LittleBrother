<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;

class SetPlayerGameTypePacket implements Packet{

    public const ID = PacketIds::SET_PLAYER_GAME_TYPE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $gamemode;
}