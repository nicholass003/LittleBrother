<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class AvailableActorIdentifiersPacket implements Packet{

    public const ID = PacketIds::AVAILABLE_ACTOR_IDENTIFIERS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $nbtData; // binary NBT compound
}