<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\DimensionIds;

class SpawnParticleEffectPacket implements Packet{

    public const ID = PacketIds::SPAWN_PARTICLE_EFFECT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public DimensionIds $dimensionId = DimensionIds::OVERWORLD;
    public int $actorUniqueId;
    public Vec3 $position;
    public string $particleName;
    public ?string $molangVariablesJson = null;
}