<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\DimensionData;

final class DimensionDataPacket implements Packet{

    public const ID = PacketIds::DIMENSION_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var array<string, DimensionData> */
    public array $definitions = [];
}