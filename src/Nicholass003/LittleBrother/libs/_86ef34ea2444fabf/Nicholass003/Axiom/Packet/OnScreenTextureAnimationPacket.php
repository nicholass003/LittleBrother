<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;

class OnScreenTextureAnimationPacket implements Packet{

    public const ID = PacketIds::ON_SCREEN_TEXTURE_ANIMATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $effectId;
}