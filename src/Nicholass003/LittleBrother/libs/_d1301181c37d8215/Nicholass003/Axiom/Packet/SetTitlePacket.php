<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class SetTitlePacket implements Packet{

    public const ID = PacketIds::SET_TITLE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $type;
    public string $text;
    public int $fadeInTime;
    public int $stayTime;
    public int $fadeOutTime;
    public string $xboxUserId = '';
    public string $platformOnlineId = '';
}