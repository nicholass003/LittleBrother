<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstructionTime{

    public function __construct(
        public readonly float $fadeInTime,
        public readonly float $stayTime,
        public readonly float $fadeOutTime
    ){}
}