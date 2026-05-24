<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class OnScreenTextureAnimationPacket implements Packet{

    public const ID = PacketIds::ON_SCREEN_TEXTURE_ANIMATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $effectId;
}