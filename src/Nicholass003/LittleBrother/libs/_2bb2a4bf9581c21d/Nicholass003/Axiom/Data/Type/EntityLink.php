<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\EntityLinkType;

class EntityLink{

    public function __construct(
        public readonly int $fromActorUniqueId,
        public readonly int $toActorUniqueId,
        public readonly EntityLinkType $type,
        public readonly bool $immediate,
        public readonly bool $causedByRider,
        public readonly float $vehicleAngularVelocity
    ){}
}