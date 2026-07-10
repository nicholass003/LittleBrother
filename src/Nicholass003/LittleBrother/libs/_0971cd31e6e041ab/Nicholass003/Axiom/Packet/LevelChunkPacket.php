<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\ChunkPosition;

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