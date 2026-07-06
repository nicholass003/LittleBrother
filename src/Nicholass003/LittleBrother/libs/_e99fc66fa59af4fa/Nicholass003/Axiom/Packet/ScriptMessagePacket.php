<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;

class ScriptMessagePacket implements Packet{

    public const ID = PacketIds::SCRIPT_MESSAGE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $channel;
    public string $message;
}