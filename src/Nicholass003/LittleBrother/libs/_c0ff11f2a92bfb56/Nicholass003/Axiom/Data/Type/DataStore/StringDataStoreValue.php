<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\DataStoreValueType;

class StringDataStoreValue extends DataStoreValue{

    public function __construct(
        public readonly string $value
    ){
        parent::__construct(DataStoreValueType::STRING);
    }
}