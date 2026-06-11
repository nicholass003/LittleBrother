<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type;

/** @since v1001 */
class WhiskerScopeDataSummary{

    public function __construct(
        public readonly string $label,
        public readonly string $identation,
        public readonly int $totalHighCostNS,
        public readonly int $totalMidCostNS,
        public readonly int $totalLowCostNS,
    ){}
}