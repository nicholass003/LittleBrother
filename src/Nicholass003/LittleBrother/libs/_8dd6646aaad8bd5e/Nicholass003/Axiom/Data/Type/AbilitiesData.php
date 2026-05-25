<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

class AbilitiesData{

    /**
     * @param AbilitiesLayer[] $abilityLayers
     */
    public function __construct(
        public readonly int $commandPermission,
        public readonly int $playerPermission,
        public readonly int $targetActorUniqueId,
        public readonly array $abilityLayers
    ){}
}