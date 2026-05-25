<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type;

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