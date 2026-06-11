<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;

class CameraPresetAimAssist{

    public function __construct(
        public readonly ?string $presetId,
        public readonly ?CameraAimAssistTargetMode $targetMode,
        public readonly ?Vec2 $viewAngle,
        public readonly ?float $distance
    ){}
}