<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

class ServerTelemetryData{

    public function __construct(
		public readonly string $serverId,
		public readonly string $scenarioId,
		public readonly string $worldId,
		public readonly string $ownerId,
    ){}
}