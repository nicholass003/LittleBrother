<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class RequestChunkRadiusPacket implements Packet{

    public const ID = PacketIds::REQUEST_CHUNK_RADIUS;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $radius;
    public int $maxRadius;
}