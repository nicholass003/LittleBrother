<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Attribute;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\EntityLink;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\MetadataEntry;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\PropertySyncData;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class AddActorPacket implements Packet{

    public const ID = PacketIds::ADD_ACTOR;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public int $actorRuntimeId;
    public string $type;
    public Vec3 $position;
    public ?Vec3 $motion = null;
    public float $pitch = 0.0;
    public float $yaw = 0.0;
    public float $headYaw = 0.0;
    public float $bodyYaw = 0.0;

    /** @var Attribute[] */
    public array $attributes = [];

    /** @var array<int, MetadataEntry> */
    public array $metadata = [];

    public PropertySyncData $syncedProperties;

    /** @var EntityLink[] */
    public array $links = [];
}