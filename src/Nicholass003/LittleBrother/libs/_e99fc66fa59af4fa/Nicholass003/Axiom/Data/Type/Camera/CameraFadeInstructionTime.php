<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstructionTime{

    public function __construct(
        public readonly float $fadeInTime,
        public readonly float $stayTime,
        public readonly float $fadeOutTime
    ){}
}