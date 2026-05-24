<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionEase{

    public function __construct(
        public readonly int $type,
        public readonly float $duration
    ){}
}