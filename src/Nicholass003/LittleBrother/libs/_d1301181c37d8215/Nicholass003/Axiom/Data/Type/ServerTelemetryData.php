<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type;

class ServerTelemetryData{

    public function __construct(
		public readonly string $serverId,
		public readonly string $scenarioId,
		public readonly string $worldId,
		public readonly string $ownerId,
    ){}
}