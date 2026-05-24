<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Camera;

class CameraFadeInstructionColor{

    public function __construct(
        public readonly float $red,
        public readonly float $green,
        public readonly float $blue
    ){}
}