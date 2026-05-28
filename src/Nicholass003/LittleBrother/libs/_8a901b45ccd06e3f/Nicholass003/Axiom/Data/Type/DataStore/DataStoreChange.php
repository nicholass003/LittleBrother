<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\DataStoreType;

class DataStoreChange extends DataStore{

    public function __construct(
        public readonly string $name,
        public readonly string $property,
        public readonly int $updateCount,
        public readonly DataStoreValue $data
    ){
        parent::__construct(DataStoreType::CHANGE);
    }
}