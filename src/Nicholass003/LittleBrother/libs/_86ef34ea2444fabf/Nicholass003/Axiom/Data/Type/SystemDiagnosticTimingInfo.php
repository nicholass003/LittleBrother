<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

/** @since v975 */
class SystemDiagnosticTimingInfo{

    public function __construct(
        public readonly string $displayName,
        public readonly int $systemIndex,
        public readonly int $timeInNS,
        public readonly int $percentOfTotal
    ){}
}