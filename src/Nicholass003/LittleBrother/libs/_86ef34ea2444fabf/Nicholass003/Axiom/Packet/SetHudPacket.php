<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\HudElement;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\HudVisibility;

class SetHudPacket implements Packet{

    public const ID = PacketIds::SET_HUD;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<HudElement> */
    public array $hudElements = [];
    public HudVisibility $visibility;
}