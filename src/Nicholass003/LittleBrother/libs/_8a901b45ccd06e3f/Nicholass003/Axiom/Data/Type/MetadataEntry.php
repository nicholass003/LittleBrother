<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\MetadataPropertyType;

class MetadataEntry{

    public function __construct(
        public readonly int $id,
        public readonly MetadataPropertyType $type,
        public readonly mixed $value
    ){}
}