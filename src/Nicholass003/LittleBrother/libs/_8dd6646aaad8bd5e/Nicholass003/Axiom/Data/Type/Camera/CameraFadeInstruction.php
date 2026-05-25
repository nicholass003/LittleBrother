<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstruction{

    public function __construct(
        public readonly ?CameraFadeInstructionTime $time,
        public readonly ?CameraFadeInstructionColor $color
    ){}
}