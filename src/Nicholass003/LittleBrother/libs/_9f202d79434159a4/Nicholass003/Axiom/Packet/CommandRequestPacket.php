<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Command\CommandOriginData;

class CommandRequestPacket implements Packet{

    public const ID = PacketIds::COMMAND_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $command;
    public CommandOriginData $originData;
    public bool $isInternal;
    /** @since v898 string $version */
    public int|string $version;
}