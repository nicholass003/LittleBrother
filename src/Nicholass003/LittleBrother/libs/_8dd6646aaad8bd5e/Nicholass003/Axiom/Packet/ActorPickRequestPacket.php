<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class ActorPickRequestPacket implements Packet{

    public const ID = PacketIds::ACTOR_PICK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorUniqueId;
    public int $hotbarSlot;
    public bool $addUserData;
}