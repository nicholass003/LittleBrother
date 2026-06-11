<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;

class SetLastHurtByPacket implements Packet{

    public const ID = PacketIds::SET_LAST_HURT_BY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $entityTypeId;
}