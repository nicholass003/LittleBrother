<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Command;

final class CommandOutputMessage{

    /** @param list<string> $parameters */
    public function __construct(
        public readonly bool $isInternal,
        public readonly string $messageId,
        public readonly array $parameters = []
    ){}
}