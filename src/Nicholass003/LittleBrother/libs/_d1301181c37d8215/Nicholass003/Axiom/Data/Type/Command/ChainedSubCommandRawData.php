<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Command;

class ChainedSubCommandRawData{

    /** @param list<ChainedSubCommandValueRawData> $valueData */
    public function __construct(
        public readonly string $name,
        public readonly array $valueData,
    ){}
}