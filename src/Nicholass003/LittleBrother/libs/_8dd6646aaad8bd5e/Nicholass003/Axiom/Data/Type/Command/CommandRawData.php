<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\CommandPermissions;

class CommandRawData{

    /**
     * @param list<int> $chainedSubCommandDataIndexes
     * @param list<CommandOverloadRawData> $overloads
     */
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly int $flags,
        public readonly CommandPermissions $permission,
        public readonly int $aliasEnumIndex,
        public readonly array $chainedSubCommandDataIndexes,
        public readonly array $overloads,
    ){}
}