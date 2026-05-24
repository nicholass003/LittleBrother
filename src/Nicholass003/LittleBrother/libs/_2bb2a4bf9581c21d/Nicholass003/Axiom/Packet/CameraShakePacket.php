<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\CameraShakeAction;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\CameraShakeType;

class CameraShakePacket implements Packet{

    public const ID = PacketIds::CAMERA_SHAKE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public float $intensity;
    public float $duration;
    public CameraShakeType $shakeType;
    public CameraShakeAction $shakeAction;
}