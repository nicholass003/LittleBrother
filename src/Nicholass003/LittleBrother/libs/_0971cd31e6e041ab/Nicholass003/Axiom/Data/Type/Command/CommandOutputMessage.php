<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Command;

final class CommandOutputMessage{

    /** @param list<string> $parameters */
    public function __construct(
        public readonly bool $isInternal,
        public readonly string $messageId,
        public readonly array $parameters = []
    ){}
}