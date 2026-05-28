<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\ResourcePackClientResponseStatus;

class ResourcePackClientResponsePacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_CLIENT_RESPONSE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ResourcePackClientResponseStatus $status;
    public array $packIds = [];
}