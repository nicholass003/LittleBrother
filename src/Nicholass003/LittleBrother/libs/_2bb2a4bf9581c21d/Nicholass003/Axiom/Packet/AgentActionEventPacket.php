<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\AgentActionType;

class AgentActionEventPacket implements Packet{

    public const ID = PacketIds::AGENT_ACTION_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $requestId;
    public AgentActionType $action;
    public string $responseJson;
}