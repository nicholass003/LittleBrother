<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\DimensionData;

final class DimensionDataPacket implements Packet{

    public const ID = PacketIds::DIMENSION_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var array<string, DimensionData> */
    public array $definitions = [];
}