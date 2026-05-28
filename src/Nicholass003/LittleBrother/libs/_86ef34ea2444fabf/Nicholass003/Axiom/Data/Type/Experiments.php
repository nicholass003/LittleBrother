<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

class Experiments{

    /**
     * @param array<string, bool> $experiments
     */
    public function __construct(
        public readonly array $experiments,
        public readonly bool $hasPreviouslyUsedExperiments
    ){}
}