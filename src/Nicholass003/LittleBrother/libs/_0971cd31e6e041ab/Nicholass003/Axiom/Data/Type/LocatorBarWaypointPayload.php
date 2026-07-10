<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class LocatorBarWaypointPayload{

    public function __construct(
        public readonly string $uuid,
        public readonly LocatorBarWaypoint $waypoint,
        public readonly int $action
    ){}
}