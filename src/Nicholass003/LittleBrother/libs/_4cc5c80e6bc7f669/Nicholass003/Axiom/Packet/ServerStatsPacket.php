<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class ServerStatsPacket implements Packet{

    public const ID = PacketIds::SERVER_STATS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public float $serverTime;
    public float $networkTime;
}