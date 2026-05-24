<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

class PlayerStartItemCooldownPacket implements Packet{

    public const ID = PacketIds::PLAYER_START_ITEM_COOLDOWN;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $itemCategory;
    public int $cooldownTicks;
}