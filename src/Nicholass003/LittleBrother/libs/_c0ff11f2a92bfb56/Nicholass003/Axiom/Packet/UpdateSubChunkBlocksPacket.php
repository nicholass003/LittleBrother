<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\SubChunk\UpdateSubChunkBlocksPacketEntry;

class UpdateSubChunkBlocksPacket implements Packet{

    public const ID = PacketIds::UPDATE_SUB_CHUNK_BLOCKS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public BlockPosition $baseBlockPosition;
    /** @var list<UpdateSubChunkBlocksPacketEntry> */
    public array $layer0Updates = [];
    /** @var list<UpdateSubChunkBlocksPacketEntry> */
    public array $layer1Updates = [];
}