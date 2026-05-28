<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\AgentAnimationType;

class AgentAnimationPacket implements Packet{

    public const ID = PacketIds::AGENT_ANIMATION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public AgentAnimationType $animationType;
    public int $actorRuntimeId;
}