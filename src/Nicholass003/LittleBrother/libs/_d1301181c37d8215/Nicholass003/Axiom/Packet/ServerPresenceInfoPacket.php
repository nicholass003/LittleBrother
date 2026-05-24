<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\PresenceConfig;

/** @since v975 */
class ServerPresenceInfoPacket implements Packet{

    public const ID = PacketIds::SERVER_PRESENCE_INFO;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ?PresenceConfig $presenceConfig = null;
}