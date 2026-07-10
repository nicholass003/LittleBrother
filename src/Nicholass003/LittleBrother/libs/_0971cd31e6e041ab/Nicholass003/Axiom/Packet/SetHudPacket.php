<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\HudElement;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\HudVisibility;

class SetHudPacket implements Packet{

    public const ID = PacketIds::SET_HUD;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<HudElement> */
    public array $hudElements = [];
    public HudVisibility $visibility;
}