<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Command;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\CommandPermissions;

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