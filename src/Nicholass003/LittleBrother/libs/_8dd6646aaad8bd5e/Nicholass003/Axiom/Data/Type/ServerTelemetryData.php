<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

class ServerTelemetryData{

    public function __construct(
		public readonly string $serverId,
		public readonly string $scenarioId,
		public readonly string $worldId,
		public readonly string $ownerId,
    ){}
}