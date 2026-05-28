<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class AddBehaviorTreePacket implements Packet{

    public const ID = PacketIds::ADD_BEHAVIOR_TREE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $behaviorTreeJson;
}