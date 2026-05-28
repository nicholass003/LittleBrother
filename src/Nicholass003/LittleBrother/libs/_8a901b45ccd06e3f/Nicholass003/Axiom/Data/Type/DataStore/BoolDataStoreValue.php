<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\DataStoreValueType;

class BoolDataStoreValue extends DataStoreValue{

    public function __construct(
        public readonly bool $value
    ){
        parent::__construct(DataStoreValueType::BOOL);
    }
}