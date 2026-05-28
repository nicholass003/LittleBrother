<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type;

/** @since v975 */
class EntityDiagnosticTimingInfo{

    public function __construct(
        public readonly string $displayName,
        public readonly string $entity,
        public readonly int $timeInNS,
        public readonly int $percentOfTotal
    ){}
}