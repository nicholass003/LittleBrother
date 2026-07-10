<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\BlockPosition;

class PlayerToggleCrafterSlotRequestPacket implements Packet{

    public const ID = PacketIds::PLAYER_TOGGLE_CRAFTER_SLOT_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BlockPosition $position;
    public int $slot;
    public bool $disabled;
}