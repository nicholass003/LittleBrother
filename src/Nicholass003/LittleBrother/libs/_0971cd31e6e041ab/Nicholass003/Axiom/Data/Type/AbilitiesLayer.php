<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class AbilitiesLayer{

    /**
     * @param bool[] $abilities
     */
    public function __construct(
        public readonly int $layerId,
        public readonly array $abilities,
        public readonly ?float $flySpeed,
        public readonly ?float $verticalFlySpeed,
        public readonly ?float $walkSpeed
    ){}
}