<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Entity\UpdateAttribute;

class UpdateAttributesPacket implements Packet{

    public const ID = PacketIds::UPDATE_ATTRIBUTES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;

    /** @var UpdateAttribute[] */
    public array $entries = [];

    public int $tick;
}