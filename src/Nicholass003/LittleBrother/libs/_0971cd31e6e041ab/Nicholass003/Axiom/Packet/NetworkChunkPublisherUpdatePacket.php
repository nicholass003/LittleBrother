<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\ChunkPosition;

class NetworkChunkPublisherUpdatePacket implements Packet{

    public const ID = PacketIds::NETWORK_CHUNK_PUBLISHER_UPDATE;
    public const RECIPIENT = PacketRecipient::CLIENT;

	public BlockPosition $blockPosition;
	public int $radius;
	/** @var ChunkPosition[] */
	public array $savedChunks = [];

	public const MAX_SAVED_CHUNKS = 9216;
}