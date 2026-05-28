<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;

class SetDisplayObjectivePacket implements Packet{

    public const ID = PacketIds::SET_DISPLAY_OBJECTIVE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $displaySlot;
    public string $objectiveName;
    public string $displayName;
    public string $criteriaName;
    public int $sortOrder;
}