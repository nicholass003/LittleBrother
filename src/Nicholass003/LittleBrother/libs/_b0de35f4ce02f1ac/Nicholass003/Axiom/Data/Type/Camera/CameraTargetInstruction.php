<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Vec3;

class CameraTargetInstruction{

    public function __construct(
        public readonly ?Vec3 $targetCenterOffset,
        public readonly int $actorUniqueId
    ){}
}