<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type;

class PlayerMovementSettingsData{

    public function __construct(
        public readonly int $rewindHistorySize,
        public readonly bool $serverAuthoritativeBlockBreaking
    ){}
}