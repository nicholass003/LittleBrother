<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class StopSoundPacket implements Packet{

    public const ID = PacketIds::STOP_SOUND;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $soundName; //TODO: should this use enum ??
    public bool $stopAll;
}