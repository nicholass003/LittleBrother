<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class CameraPacket implements Packet{

    public const ID = PacketIds::CAMERA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $cameraActorUniqueId;
    public int $playerActorUniqueId;
}