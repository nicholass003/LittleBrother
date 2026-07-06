<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\MetadataPropertyType;

class MetadataEntry{

    public function __construct(
        public readonly int $id,
        public readonly MetadataPropertyType $type,
        public readonly mixed $value
    ){}
}