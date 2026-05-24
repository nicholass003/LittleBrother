<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\EntityLinkType;

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