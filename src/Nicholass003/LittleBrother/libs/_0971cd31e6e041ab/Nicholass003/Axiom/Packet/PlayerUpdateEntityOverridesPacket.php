<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\OverrideUpdateType;

class PlayerUpdateEntityOverridesPacket implements Packet{

    public const ID = PacketIds::PLAYER_UPDATE_ENTITY_OVERRIDES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public int $propertyIndex;
    public OverrideUpdateType $updateType;
    public int|float|null $overrideValue = null;
}