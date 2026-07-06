<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\ControlScheme;

class CameraPreset{

    public const AUDIO_LISTENER_TYPE_CAMERA = 0;
    public const AUDIO_LISTENER_TYPE_PLAYER = 1;

    public function __construct(
        public readonly string $name,
        public readonly string $parent,
        public readonly ?float $xPosition,
        public readonly ?float $yPosition,
        public readonly ?float $zPosition,
        public readonly ?float $pitch,
        public readonly ?float $yaw,
        public readonly ?float $rotationSpeed,
        public readonly ?bool $snapToTarget,
        public readonly ?Vec2 $horizontalRotationLimit,
        public readonly ?Vec2 $verticalRotationLimit,
        public readonly ?bool $continueTargeting,
        public readonly ?float $blockListeningRadius,
        public readonly ?Vec2 $viewOffset,
        public readonly ?Vec3 $entityOffset,
        public readonly ?float $radius,
        public readonly ?float $yawLimitMin,
        public readonly ?float $yawLimitMax,
        public readonly ?int $audioListenerType,
        public readonly ?bool $playerEffects,
        public readonly ?CameraPresetAimAssist $aimAssist,
        public readonly ?ControlScheme $controlScheme
    ){}
}