<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\LocatorBarWaypointPayload;

class LocatorBarPacket implements Packet{

    public const ID = PacketIds::LOCATOR_BAR;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<LocatorBarWaypointPayload> */
    public array $waypoints = [];
}