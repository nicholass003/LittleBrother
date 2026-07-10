<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Map\MapInfoRequestPacketClientPixel;

class MapInfoRequestPacket implements Packet{

    public const ID = PacketIds::MAP_INFO_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $mapId;
    /** @var list<MapInfoRequestPacketClientPixel> */
    public array $clientPixels = [];
}