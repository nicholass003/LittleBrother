<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class OnScreenTextureAnimationPacket implements Packet{

    public const ID = PacketIds::ON_SCREEN_TEXTURE_ANIMATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $effectId;
}