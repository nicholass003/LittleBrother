<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class CameraTargetInstruction{

    public function __construct(
        public readonly ?Vec3 $targetCenterOffset,
        public readonly int $actorUniqueId
    ){}
}