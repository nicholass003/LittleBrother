<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Vec3;

/** @since v859 */
class CameraSplineInstruction{

	/** @since v944 */
	public readonly string $splineIdentifier;
	/** @since v944 */
	public readonly bool $loadFromJson;

    /**
     * @param list<Vec3> $curve
     * @param list<CameraProgressOption> $progressKeyFrames
     * @param list<CameraRotationOption> $rotationOptions
     */
	public function __construct(
		public readonly float $totalTime,
		public readonly int $easeType,
		public readonly array $curve,
		public readonly array $progressKeyFrames,
		public readonly array $rotationOptions,
		string $splineIdentifier = '',
		bool $loadFromJson = false,
	){
		$this->splineIdentifier = $splineIdentifier;
		$this->loadFromJson = $loadFromJson;
	}
}