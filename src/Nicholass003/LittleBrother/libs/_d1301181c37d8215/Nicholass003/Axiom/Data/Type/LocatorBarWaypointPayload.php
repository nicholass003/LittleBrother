<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type;

class LocatorBarWaypointPayload{

    public function __construct(
        public readonly string $uuid,
        public readonly LocatorBarWaypoint $waypoint,
        public readonly int $action
    ){}
}