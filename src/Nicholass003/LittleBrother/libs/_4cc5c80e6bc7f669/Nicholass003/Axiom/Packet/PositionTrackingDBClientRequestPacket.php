<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\PositionTrackingClientAction;

class PositionTrackingDBClientRequestPacket implements Packet{

    public const ID = PacketIds::POSITION_TRACKING_DB_CLIENT_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public PositionTrackingClientAction $action;
    public int $trackingId;
}