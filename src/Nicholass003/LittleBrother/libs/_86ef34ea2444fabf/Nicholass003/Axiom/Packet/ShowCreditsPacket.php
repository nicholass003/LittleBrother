<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\ShowCreditsStatus;

class ShowCreditsPacket implements Packet{

    public const ID = PacketIds::SHOW_CREDITS;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $playerActorRuntimeId;
    public ShowCreditsStatus $status;
}