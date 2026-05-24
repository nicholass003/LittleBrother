<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

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