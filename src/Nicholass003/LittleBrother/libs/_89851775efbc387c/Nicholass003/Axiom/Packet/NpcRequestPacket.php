<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\NpcRequestType;

class NpcRequestPacket implements Packet{

    public const ID = PacketIds::NPC_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorRuntimeId;
    public NpcRequestType $requestType;
    public string $commandString;
    public int $actionIndex;
    public string $sceneName;
}