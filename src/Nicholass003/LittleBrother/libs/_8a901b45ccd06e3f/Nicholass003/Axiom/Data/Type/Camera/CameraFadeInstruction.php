<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstruction{

    public function __construct(
        public readonly ?CameraFadeInstructionTime $time,
        public readonly ?CameraFadeInstructionColor $color
    ){}
}