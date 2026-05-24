<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type;

class Experiments{

    /**
     * @param array<string, bool> $experiments
     */
    public function __construct(
        public readonly array $experiments,
        public readonly bool $hasPreviouslyUsedExperiments
    ){}
}