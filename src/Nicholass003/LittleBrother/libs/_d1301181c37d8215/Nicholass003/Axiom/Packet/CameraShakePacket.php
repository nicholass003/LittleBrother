<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\CameraShakeAction;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\CameraShakeType;

class CameraShakePacket implements Packet{

    public const ID = PacketIds::CAMERA_SHAKE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public float $intensity;
    public float $duration;
    public CameraShakeType $shakeType;
    public CameraShakeAction $shakeAction;
}