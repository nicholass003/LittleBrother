<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\ChunkCacheBlob;

final class ClientCacheMissResponsePacket implements Packet{

    public const ID = PacketIds::CLIENT_CACHE_MISS_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ChunkCacheBlob> */
    public array $blobs = [];
}