<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class AddPaintingPacket implements Packet{

    public const ID = PacketIds::ADD_PAINTING;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorUniqueId;
    public int $actorRuntimeId;
    public Vec3 $position;
    public int $direction;
    public string $title;
}