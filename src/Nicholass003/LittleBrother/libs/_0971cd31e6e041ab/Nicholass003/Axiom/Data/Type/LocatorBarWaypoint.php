<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class LocatorBarWaypoint{

    public function __construct(
        public readonly int $updateFlag,
        public readonly ?bool $visible,
		public readonly ?WorldPosition $worldPosition,
		public readonly ?int $textureId,
		public readonly ?int $color,
		public readonly ?bool $clientPositionAuthority,
		public readonly ?int $actorUniqueId,
    ){}
}