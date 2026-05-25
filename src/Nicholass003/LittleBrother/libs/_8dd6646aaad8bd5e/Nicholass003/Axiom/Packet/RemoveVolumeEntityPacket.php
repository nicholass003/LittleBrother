<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class RemoveVolumeEntityPacket implements Packet{

    public const ID = PacketIds::REMOVE_VOLUME_ENTITY;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $entityNetId;
    public int $dimension;
}