<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Entity\UpdateAttribute;

class UpdateAttributesPacket implements Packet{

    public const ID = PacketIds::UPDATE_ATTRIBUTES;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;

    /** @var UpdateAttribute[] */
    public array $entries = [];

    public int $tick;
}