<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\EntityLink;

class SetActorLinkPacket implements Packet{

    public const ID = PacketIds::SET_ACTOR_LINK;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public EntityLink $link;
}