<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Camera;

class CameraAimAssistActorPriority{

	public function __construct(
		public readonly int $presetIndex,
		public readonly int $categoryIndex,
		public readonly int $actorIndex,
		public readonly int $priority,
	){}
}