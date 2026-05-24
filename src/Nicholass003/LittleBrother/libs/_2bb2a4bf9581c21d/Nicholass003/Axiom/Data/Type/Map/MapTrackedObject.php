<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Map;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\MapTrackedObjectType;

class MapTrackedObject{

    public function __construct(
        public readonly MapTrackedObjectType $type,
        public readonly ?int $actorUniqueId = null,
        public readonly ?BlockPosition $blockPosition = null
    ){}
}