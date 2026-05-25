<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

/** @since v975 */
class EntityDiagnosticTimingInfo{

    public function __construct(
        public readonly string $displayName,
        public readonly string $entity,
        public readonly int $timeInNS,
        public readonly int $percentOfTotal
    ){}
}