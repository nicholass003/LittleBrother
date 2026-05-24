<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class ResourcePackChunkRequestPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_CHUNK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $packId;
    public int $chunkIndex;
}