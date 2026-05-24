<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPosition;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPositionOffset;

class SubChunkRequestPacket implements Packet{

    public const ID = PacketIds::SUB_CHUNK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $dimension;
    public SubChunkPosition $basePosition;
    /** @var list<SubChunkPositionOffset> */
    public array $entries = [];
}