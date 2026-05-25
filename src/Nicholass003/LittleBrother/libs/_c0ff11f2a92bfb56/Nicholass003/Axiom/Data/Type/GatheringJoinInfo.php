<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

class GatheringJoinInfo{

    public function __construct(
		public readonly string $experienceId,
		public readonly string $experienceName,
		public readonly string $experienceWorldId,
		public readonly string $experienceWorldName,
		public readonly string $creatorId,
		public readonly string $targetId,
		public readonly string $scenarioId,
		public readonly string $serverId
    ){}
}