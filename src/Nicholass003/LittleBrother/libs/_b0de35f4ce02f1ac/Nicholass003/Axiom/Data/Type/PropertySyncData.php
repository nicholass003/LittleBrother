<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

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