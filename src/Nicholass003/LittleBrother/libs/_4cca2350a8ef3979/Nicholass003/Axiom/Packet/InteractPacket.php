<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\InteractAction;

class InteractPacket implements Packet{

    public const ID = PacketIds::INTERACT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public InteractAction $action;
    public int $targetActorRuntimeId;
    public ?Vec3 $position = null;
}