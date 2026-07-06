<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistCategory;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera\CameraAimAssistPreset;

class CameraAimAssistPresetsPacket implements Packet{

    public const ID = PacketIds::CAMERA_AIM_ASSIST_PRESETS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<CameraAimAssistCategory> */
    public array $categories = [];
    /** @var list<CameraAimAssistPreset> */
    public array $presets = [];
    public int $operation;
}