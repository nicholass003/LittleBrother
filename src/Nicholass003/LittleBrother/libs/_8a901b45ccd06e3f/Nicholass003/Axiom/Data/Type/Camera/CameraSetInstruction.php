<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec2;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class CameraSetInstruction{

    public function __construct(
        public readonly int $preset,
        public readonly ?CameraSetInstructionEase $ease,
        public readonly ?Vec3 $cameraPosition,
        public readonly ?CameraSetInstructionRotation $rotation,
        public readonly ?Vec3 $facingPosition,
        public readonly ?Vec2 $viewOffset,
        public readonly ?Vec3 $entityOffset,
        public readonly ?bool $default,
        public readonly bool $ignoreStartingValuesComponent
    ){}
}