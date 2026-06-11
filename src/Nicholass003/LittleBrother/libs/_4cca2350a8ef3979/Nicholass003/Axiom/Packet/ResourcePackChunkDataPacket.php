<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;

class ResourcePackChunkDataPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_CHUNK_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $packId;
    public int $chunkIndex;
    public int $offset;
    public string $data;
}