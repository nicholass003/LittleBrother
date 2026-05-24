<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

class ServerTelemetryData{

    public function __construct(
		public readonly string $serverId,
		public readonly string $scenarioId,
		public readonly string $worldId,
		public readonly string $ownerId,
    ){}
}