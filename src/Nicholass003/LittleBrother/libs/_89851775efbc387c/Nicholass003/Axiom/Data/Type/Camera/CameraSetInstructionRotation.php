<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionRotation{

    public function __construct(
        public readonly float $pitch,
        public readonly float $yaw
    ){}
}