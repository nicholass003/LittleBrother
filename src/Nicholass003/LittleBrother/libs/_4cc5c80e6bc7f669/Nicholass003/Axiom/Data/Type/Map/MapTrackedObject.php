<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Map;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\MapTrackedObjectType;

class MapTrackedObject{

    public function __construct(
        public readonly MapTrackedObjectType $type,
        public readonly ?int $actorUniqueId = null,
        public readonly ?BlockPosition $blockPosition = null
    ){}
}