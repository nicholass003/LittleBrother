<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\PresenceConfig;

/** @since v975 */
class ServerPresenceInfoPacket implements Packet{

    public const ID = PacketIds::SERVER_PRESENCE_INFO;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ?PresenceConfig $presenceConfig = null;
}