<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Camera\CameraPreset;

class CameraPresetsPacket implements Packet{

    public const ID = PacketIds::CAMERA_PRESETS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<CameraPreset> */
    public array $presets = [];
}