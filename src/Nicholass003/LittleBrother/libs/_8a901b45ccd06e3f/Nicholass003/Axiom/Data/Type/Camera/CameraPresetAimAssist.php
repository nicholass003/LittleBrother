<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;

class CameraPresetAimAssist{

    public function __construct(
        public readonly ?string $presetId,
        public readonly ?CameraAimAssistTargetMode $targetMode,
        public readonly ?Vec2 $viewAngle,
        public readonly ?float $distance
    ){}
}