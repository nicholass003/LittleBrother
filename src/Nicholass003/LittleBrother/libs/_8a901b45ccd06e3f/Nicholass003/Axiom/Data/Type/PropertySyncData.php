<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

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