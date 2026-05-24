<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\UpdateBlockSyncedType;

class UpdateBlockSyncedPacket extends UpdateBlockPacket{

    public const ID = PacketIds::UPDATE_BLOCK_SYNCED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public UpdateBlockSyncedType $updateType;
}