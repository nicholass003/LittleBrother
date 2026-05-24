<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Vec3;

class CameraTargetInstruction{

    public function __construct(
        public readonly ?Vec3 $targetCenterOffset,
        public readonly int $actorUniqueId
    ){}
}