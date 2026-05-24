<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\NpcRequestType;

class NpcRequestPacket implements Packet{

    public const ID = PacketIds::NPC_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorRuntimeId;
    public NpcRequestType $requestType;
    public string $commandString;
    public int $actionIndex;
    public string $sceneName;
}