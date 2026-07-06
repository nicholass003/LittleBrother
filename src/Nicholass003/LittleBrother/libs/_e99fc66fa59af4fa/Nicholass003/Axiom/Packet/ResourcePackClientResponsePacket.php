<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ResourcePackClientResponseStatus;

class ResourcePackClientResponsePacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_CLIENT_RESPONSE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ResourcePackClientResponseStatus $status;
    public array $packIds = [];
}