<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\RequestAbilityType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\RequestAbilityValueType;

class RequestAbilityPacket implements Packet{

    public const ID = PacketIds::REQUEST_ABILITY;
    public const RECIPIENT = PacketRecipient::SERVER;

    public RequestAbilityType $abilityId;
    public bool|float $abilityValue;
    public RequestAbilityValueType $valueType;
}