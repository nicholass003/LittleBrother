<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

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