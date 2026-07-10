<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera;

class CameraAimAssistActorPriority{

	public function __construct(
		public readonly int $presetIndex,
		public readonly int $categoryIndex,
		public readonly int $actorIndex,
		public readonly int $priority,
	){}
}