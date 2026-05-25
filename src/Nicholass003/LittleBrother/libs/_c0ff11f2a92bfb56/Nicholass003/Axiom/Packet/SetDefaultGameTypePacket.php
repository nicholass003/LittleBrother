<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class SetDefaultGameTypePacket implements Packet{

    public const ID = PacketIds::SET_DEFAULT_GAME_TYPE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $gamemode; //TODO: should this use enum ??
}