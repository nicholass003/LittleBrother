<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\MetadataPropertyType;

class MetadataEntry{

    public function __construct(
        public readonly int $id,
        public readonly MetadataPropertyType $type,
        public readonly mixed $value
    ){}
}