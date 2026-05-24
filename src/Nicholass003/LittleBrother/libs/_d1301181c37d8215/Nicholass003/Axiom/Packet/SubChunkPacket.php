<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketEntryWithCache;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketEntryWithoutCache;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPosition;

class SubChunkPacket implements Packet{

    public const ID = PacketIds::SUB_CHUNK;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $dimension;
    public SubChunkPosition $baseSubChunkPosition;
    /** @var list<SubChunkPacketEntryWithCache|SubChunkPacketEntryWithoutCache> */
    public array $entries = [];
    public bool $cacheEnabled = false;
}