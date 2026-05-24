<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class PlayerToggleCrafterSlotRequestPacket implements Packet{

    public const ID = PacketIds::PLAYER_TOGGLE_CRAFTER_SLOT_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BlockPosition $position;
    public int $slot;
    public bool $disabled;
}