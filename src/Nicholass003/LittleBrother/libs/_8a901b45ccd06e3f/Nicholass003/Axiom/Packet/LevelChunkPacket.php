<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\ChunkPosition;

class LevelChunkPacket implements Packet{

    public const ID = PacketIds::LEVEL_CHUNK;
    public const RECIPIENT = PacketRecipient::CLIENT;

	public ChunkPosition $position;
	public int $dimensionId;
	public int $subChunkCount;
	public bool $clientSubChunkRequestsEnabled;
	public ?array $usedBlobHashes = null;
	public string $payload;
}