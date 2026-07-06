<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\InteractAction;

class InteractPacket implements Packet{

    public const ID = PacketIds::INTERACT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public InteractAction $action;
    public int $targetActorRuntimeId;
    public ?Vec3 $position = null;
}