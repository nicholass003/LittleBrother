<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Debug\DebugMarkerData;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\ClientboundDebugRendererType;

class ClientboundDebugRendererPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_DEBUG_RENDERER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ClientboundDebugRendererType $type;
    public string $text;
    public Vec3 $position;
    public float $red;
    public float $green;
    public float $blue;
    public float $alpha;
    public int $durationMillis;

    public ?DebugMarkerData $data;
}