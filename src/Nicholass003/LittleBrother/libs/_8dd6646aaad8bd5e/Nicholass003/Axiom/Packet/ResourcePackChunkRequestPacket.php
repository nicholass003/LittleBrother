<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class ResourcePackChunkRequestPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_CHUNK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $packId;
    public int $chunkIndex;
}