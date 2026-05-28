<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\ActorEventType;

class ActorEventPacket implements Packet{

    public const ID = PacketIds::ACTOR_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public ActorEventType $eventId;
    public int $eventData;
    /** @since v975 */
    public ?Vec3 $firePosition = null;
}