<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\CameraAimAssistTargetMode;

class CameraPresetAimAssist{

    public function __construct(
        public readonly ?string $presetId,
        public readonly ?CameraAimAssistTargetMode $targetMode,
        public readonly ?Vec2 $viewAngle,
        public readonly ?float $distance
    ){}
}