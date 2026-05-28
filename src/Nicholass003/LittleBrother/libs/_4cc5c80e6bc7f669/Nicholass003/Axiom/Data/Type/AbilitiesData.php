<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type;

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