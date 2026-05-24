<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\PositionTrackingAction;

class PositionTrackingDBServerBroadcastPacket implements Packet{

    public const ID = PacketIds::POSITION_TRACKING_DB_SERVER_BROADCAST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public PositionTrackingAction $action;
    public int $trackingId;
    public string $nbt; // Raw NBT binary
}