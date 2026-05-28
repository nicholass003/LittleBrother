<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\DataStoreType;

class DataStoreRemoval extends DataStore{

    public function __construct(
        public readonly string $name
    ){
        parent::__construct(DataStoreType::REMOVAL);
    }
}