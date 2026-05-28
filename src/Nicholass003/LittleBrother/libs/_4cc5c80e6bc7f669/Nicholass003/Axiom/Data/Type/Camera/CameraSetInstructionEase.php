<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Camera;

class CameraSetInstructionEase{

    public function __construct(
        public readonly int $type,
        public readonly float $duration
    ){}
}