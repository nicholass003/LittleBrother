<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\DataStoreType;

abstract class DataStore{

    public function __construct(
        public readonly DataStoreType $type
    ){}
}