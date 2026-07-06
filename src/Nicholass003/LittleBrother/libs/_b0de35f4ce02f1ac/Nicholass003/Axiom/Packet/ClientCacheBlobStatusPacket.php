<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;

class ClientCacheBlobStatusPacket implements Packet{

    public const ID = PacketIds::CLIENT_CACHE_BLOB_STATUS;
    public const RECIPIENT = PacketRecipient::SERVER;

    /** @var list<int> */
    public array $hitHashes = [];
    /** @var list<int> */
    public array $missHashes = [];
}