<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionRotation{

    public function __construct(
        public readonly float $pitch,
        public readonly float $yaw
    ){}
}