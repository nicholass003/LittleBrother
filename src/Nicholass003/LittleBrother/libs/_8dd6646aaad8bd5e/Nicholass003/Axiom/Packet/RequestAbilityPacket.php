<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\RequestAbilityType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\RequestAbilityValueType;

class RequestAbilityPacket implements Packet{

    public const ID = PacketIds::REQUEST_ABILITY;
    public const RECIPIENT = PacketRecipient::SERVER;

    public RequestAbilityType $abilityId;
    public bool|float $abilityValue;
    public RequestAbilityValueType $valueType;
}