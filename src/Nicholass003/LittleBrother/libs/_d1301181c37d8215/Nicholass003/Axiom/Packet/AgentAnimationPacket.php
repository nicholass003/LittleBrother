<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\AgentAnimationType;

class AgentAnimationPacket implements Packet{

    public const ID = PacketIds::AGENT_ANIMATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public AgentAnimationType $animationType;
    public int $actorRuntimeId;
}