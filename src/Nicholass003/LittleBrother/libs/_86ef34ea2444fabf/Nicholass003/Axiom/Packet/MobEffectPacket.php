<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\MobEffectEvent;

class MobEffectPacket implements Packet{

    public const ID = PacketIds::MOB_EFFECT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public MobEffectEvent $eventId;
    public int $effectId;
    public int $amplifier;
    public bool $particles = true;
    public int $duration;
    public int $tick;
    /** @since v898 */
    public bool $ambient = true;
}