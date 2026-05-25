<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class ChangeMobPropertyPacket implements Packet{

    public const ID = PacketIds::CHANGE_MOB_PROPERTY;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorUniqueId;
    public string $propertyName;
    public bool $boolValue;
    public string $stringValue;
    public int $intValue;
    public float $floatValue;
}