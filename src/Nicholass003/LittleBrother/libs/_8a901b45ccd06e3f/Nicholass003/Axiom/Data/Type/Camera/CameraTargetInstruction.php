<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class CameraTargetInstruction{

    public function __construct(
        public readonly ?Vec3 $targetCenterOffset,
        public readonly int $actorUniqueId
    ){}
}