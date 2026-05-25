<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Camera;

class CameraAimAssistActorPriority{

	public function __construct(
		public readonly int $presetIndex,
		public readonly int $categoryIndex,
		public readonly int $actorIndex,
		public readonly int $priority,
	){}
}