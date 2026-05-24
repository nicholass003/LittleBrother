<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\UpdateBlockSyncedType;

class UpdateBlockSyncedPacket extends UpdateBlockPacket{

    public const ID = PacketIds::UPDATE_BLOCK_SYNCED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public UpdateBlockSyncedType $updateType;
}