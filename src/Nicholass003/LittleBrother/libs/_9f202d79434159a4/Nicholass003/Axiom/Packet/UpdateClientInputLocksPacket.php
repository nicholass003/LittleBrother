<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Vec3;

class UpdateClientInputLocksPacket implements Packet{

    public const ID = PacketIds::UPDATE_CLIENT_INPUT_LOCKS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $flags;
    /** @deprecated v944 */
    public ?Vec3 $position = null;
}