<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;

class CameraPacket implements Packet{

    public const ID = PacketIds::CAMERA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $cameraActorUniqueId;
    public int $playerActorUniqueId;
}