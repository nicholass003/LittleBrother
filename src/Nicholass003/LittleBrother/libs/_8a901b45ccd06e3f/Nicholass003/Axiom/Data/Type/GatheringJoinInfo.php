<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

class GatheringJoinInfo{

    /** @since v975 */
	public readonly string $targetId;
    /** @since v975 */
	public readonly string $scenarioId;
    /** @since v975 */
	public readonly string $serverId;

    public function __construct(
		public readonly string $experienceId,
		public readonly string $experienceName,
		public readonly string $experienceWorldId,
		public readonly string $experienceWorldName,
		public readonly string $creatorId,
		string $targetId = '',
		string $scenarioId = '',
		string $serverId = ''
    ){
		$this->targetId = $targetId;
		$this->scenarioId = $scenarioId;
		$this->serverId = $serverId;
	}
}