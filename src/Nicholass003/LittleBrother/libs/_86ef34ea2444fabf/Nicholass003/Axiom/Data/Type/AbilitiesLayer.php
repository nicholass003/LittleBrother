<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

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