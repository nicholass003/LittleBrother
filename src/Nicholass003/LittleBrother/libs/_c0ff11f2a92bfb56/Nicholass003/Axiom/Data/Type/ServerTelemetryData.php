<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

class ServerTelemetryData{

    public function __construct(
		public readonly string $serverId,
		public readonly string $scenarioId,
		public readonly string $worldId,
		public readonly string $ownerId,
    ){}
}