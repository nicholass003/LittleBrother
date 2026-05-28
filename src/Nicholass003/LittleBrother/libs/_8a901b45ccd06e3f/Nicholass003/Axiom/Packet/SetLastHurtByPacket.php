<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class SetLastHurtByPacket implements Packet{

    public const ID = PacketIds::SET_LAST_HURT_BY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $entityTypeId;
}