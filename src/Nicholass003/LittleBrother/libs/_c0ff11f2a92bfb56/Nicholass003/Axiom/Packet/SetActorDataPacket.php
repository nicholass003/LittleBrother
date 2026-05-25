<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\MetadataEntry;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\PropertySyncData;

class SetActorDataPacket implements Packet{

    public const ID = PacketIds::SET_ACTOR_DATA;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorRuntimeId;

    /** @var MetadataEntry[] */
    public array $metadata = [];

    public PropertySyncData $syncedProperties;

    public int $tick;
}