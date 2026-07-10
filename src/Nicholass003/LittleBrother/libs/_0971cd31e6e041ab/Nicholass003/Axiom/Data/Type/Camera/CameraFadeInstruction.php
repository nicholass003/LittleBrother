<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstruction{

    public function __construct(
        public readonly ?CameraFadeInstructionTime $time,
        public readonly ?CameraFadeInstructionColor $color
    ){}
}