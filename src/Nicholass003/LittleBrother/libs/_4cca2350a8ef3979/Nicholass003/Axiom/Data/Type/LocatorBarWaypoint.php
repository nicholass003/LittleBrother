<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type;

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