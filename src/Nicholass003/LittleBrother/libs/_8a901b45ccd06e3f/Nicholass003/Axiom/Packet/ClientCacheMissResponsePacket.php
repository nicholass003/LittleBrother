<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\ChunkCacheBlob;

final class ClientCacheMissResponsePacket implements Packet{

    public const ID = PacketIds::CLIENT_CACHE_MISS_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ChunkCacheBlob> */
    public array $blobs = [];
}