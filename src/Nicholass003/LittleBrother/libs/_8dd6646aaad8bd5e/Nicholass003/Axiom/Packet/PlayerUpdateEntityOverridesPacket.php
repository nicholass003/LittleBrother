<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\OverrideUpdateType;

class PlayerUpdateEntityOverridesPacket implements Packet{

    public const ID = PacketIds::PLAYER_UPDATE_ENTITY_OVERRIDES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public int $propertyIndex;
    public OverrideUpdateType $updateType;
    public int|float|null $overrideValue = null;
}