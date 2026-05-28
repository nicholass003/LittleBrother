<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Map\MapInfoRequestPacketClientPixel;

class MapInfoRequestPacket implements Packet{

    public const ID = PacketIds::MAP_INFO_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $mapId;
    /** @var list<MapInfoRequestPacketClientPixel> */
    public array $clientPixels = [];
}