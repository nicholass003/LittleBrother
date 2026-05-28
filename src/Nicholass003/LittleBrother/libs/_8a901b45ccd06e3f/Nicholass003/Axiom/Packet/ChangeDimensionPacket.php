<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class ChangeDimensionPacket implements Packet{

    public const ID = PacketIds::CHANGE_DIMENSION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $dimension;
    public Vec3 $position;
    public bool $respawn;
    public ?int $loadingScreenId = null;
}