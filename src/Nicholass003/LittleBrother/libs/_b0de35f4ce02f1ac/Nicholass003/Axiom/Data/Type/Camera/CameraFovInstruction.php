<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;

class CameraFovInstruction{

    public function __construct(
        public readonly float $fieldOfView,
        public readonly float $easeTime,
        public readonly CameraSetInstructionEaseType $easeType,
        public readonly bool $clear
    ){}
}