<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SubChunk\UpdateSubChunkBlocksPacketEntry;

class UpdateSubChunkBlocksPacket implements Packet{

    public const ID = PacketIds::UPDATE_SUB_CHUNK_BLOCKS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public BlockPosition $baseBlockPosition;
    /** @var list<UpdateSubChunkBlocksPacketEntry> */
    public array $layer0Updates = [];
    /** @var list<UpdateSubChunkBlocksPacketEntry> */
    public array $layer1Updates = [];
}