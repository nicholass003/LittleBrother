<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

class LocatorBarWaypointPayload{

    public function __construct(
        public readonly string $uuid,
        public readonly LocatorBarWaypoint $waypoint,
        public readonly int $action
    ){}
}