<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\CameraShakeAction;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\CameraShakeType;

class CameraShakePacket implements Packet{

    public const ID = PacketIds::CAMERA_SHAKE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public float $intensity;
    public float $duration;
    public CameraShakeType $shakeType;
    public CameraShakeAction $shakeAction;
}