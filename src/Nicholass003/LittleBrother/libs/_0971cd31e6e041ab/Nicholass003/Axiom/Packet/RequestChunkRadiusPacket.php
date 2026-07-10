<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class RequestChunkRadiusPacket implements Packet{

    public const ID = PacketIds::REQUEST_CHUNK_RADIUS;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $radius;
    public int $maxRadius;
}