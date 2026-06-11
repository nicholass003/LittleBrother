<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionEase{

    public function __construct(
        public readonly int $type,
        public readonly float $duration
    ){}
}