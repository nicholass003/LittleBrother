<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\MetadataPropertyType;

class MetadataEntry{

    public function __construct(
        public readonly int $id,
        public readonly MetadataPropertyType $type,
        public readonly mixed $value
    ){}
}