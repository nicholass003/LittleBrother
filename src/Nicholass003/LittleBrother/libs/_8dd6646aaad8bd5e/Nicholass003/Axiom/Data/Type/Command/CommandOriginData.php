<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CommandOriginType;

class CommandOriginData{

    public function __construct(
        public readonly CommandOriginType $type,
        public readonly string $uuid, // raw 16-byte string
        public readonly string $requestId,
        public readonly int $playerActorUniqueId = 0
    ){}
}