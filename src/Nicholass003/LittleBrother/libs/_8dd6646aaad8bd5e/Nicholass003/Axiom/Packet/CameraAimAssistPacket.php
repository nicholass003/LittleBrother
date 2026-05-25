<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CameraAimAssistActionType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;

class CameraAimAssistPacket implements Packet{

    public const ID = PacketIds::CAMERA_AIM_ASSIST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $presetId;
    public Vec2 $viewAngle;
    public float $distance;
    public CameraAimAssistTargetMode $targetMode;
    public CameraAimAssistActionType $actionType;
    public bool $showDebugRender;
}