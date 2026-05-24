<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ChunkPosition;

class NetworkChunkPublisherUpdatePacket implements Packet{

    public const ID = PacketIds::NETWORK_CHUNK_PUBLISHER_UPDATE;
    public const RECIPIENT = PacketRecipient::CLIENT;

	public BlockPosition $blockPosition;
	public int $radius;
	/** @var ChunkPosition[] */
	public array $savedChunks = [];

	public const MAX_SAVED_CHUNKS = 9216;
}