<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\CameraAimAssistActionType;

final class ClientCameraAimAssistPacket implements Packet{

    public const ID = PacketIds::CLIENT_CAMERA_AIM_ASSIST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $presetId;
    public CameraAimAssistActionType $actionType;
    public bool $allowAimAssist;
}