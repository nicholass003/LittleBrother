<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

final class ClientCacheStatusPacket implements Packet{

    public const ID = PacketIds::CLIENT_CACHE_STATUS;
    public const RECIPIENT = PacketRecipient::SERVER;

    public bool $enabled;
}