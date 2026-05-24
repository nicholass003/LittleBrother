<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type;

class PropertySyncData{

    /**
     * @param array<int, int>   $intProperties
     * @param array<int, float> $floatProperties
     */
    public function __construct(
        public readonly array $intProperties,
        public readonly array $floatProperties,
    ){}
}