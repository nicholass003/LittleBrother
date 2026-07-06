<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Command;

final class CommandOutputMessage{

    /** @param list<string> $parameters */
    public function __construct(
        public readonly bool $isInternal,
        public readonly string $messageId,
        public readonly array $parameters = []
    ){}
}