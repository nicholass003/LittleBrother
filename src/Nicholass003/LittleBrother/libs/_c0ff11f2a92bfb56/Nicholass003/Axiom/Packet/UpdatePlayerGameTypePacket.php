<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\GameMode;

class UpdatePlayerGameTypePacket implements Packet{

    public const ID = PacketIds::UPDATE_PLAYER_GAME_TYPE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public GameMode $gameMode;
    public int $playerActorUniqueId;
    public int $tick;
}