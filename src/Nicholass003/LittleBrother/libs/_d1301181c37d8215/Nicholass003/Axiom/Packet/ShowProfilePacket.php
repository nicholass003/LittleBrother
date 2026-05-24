<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class ShowProfilePacket implements Packet{

    public const ID = PacketIds::SHOW_PROFILE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $xboxUserId;
}