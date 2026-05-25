<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Camera;

class CameraSplineDefinition{

    public function __construct(
        public readonly string $name,
        public readonly CameraSplineInstruction $instruction
    ){}
}