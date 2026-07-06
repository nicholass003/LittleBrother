<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Command;

class ChainedSubCommandRawData{

    /** @param list<ChainedSubCommandValueRawData> $valueData */
    public function __construct(
        public readonly string $name,
        public readonly array $valueData,
    ){}
}