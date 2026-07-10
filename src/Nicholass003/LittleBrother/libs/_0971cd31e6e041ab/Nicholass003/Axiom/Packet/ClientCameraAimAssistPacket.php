<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\CameraAimAssistActionType;

final class ClientCameraAimAssistPacket implements Packet{

    public const ID = PacketIds::CLIENT_CAMERA_AIM_ASSIST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $presetId;
    public CameraAimAssistActionType $actionType;
    public bool $allowAimAssist;
}