<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\DataStoreValueType;

abstract class DataStoreValue{

    public function __construct(
        public readonly DataStoreValueType $type
    ){}
}