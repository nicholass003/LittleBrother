<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Command;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\CommandOriginType;

class CommandOriginData{

    public function __construct(
        public readonly CommandOriginType $type,
        public readonly string $uuid, // raw 16-byte string
        public readonly string $requestId,
        public readonly int $playerActorUniqueId = 0
    ){}
}