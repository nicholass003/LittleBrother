<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionEase{

    public function __construct(
        public readonly int $type,
        public readonly float $duration
    ){}
}