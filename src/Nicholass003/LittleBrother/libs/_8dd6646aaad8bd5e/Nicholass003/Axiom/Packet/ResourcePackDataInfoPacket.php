<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\ResourcePackType;

class ResourcePackDataInfoPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_DATA_INFO;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $packId;
    public int $maxChunkSize;
    public int $chunkCount;
    public int $compressedPackSize;
    public string $sha256;
    public bool $isPremium = false;
    public ResourcePackType $packType = ResourcePackType::RESOURCES;
}