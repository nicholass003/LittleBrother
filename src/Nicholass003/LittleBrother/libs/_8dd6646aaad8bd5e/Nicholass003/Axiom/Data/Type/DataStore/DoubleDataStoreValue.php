<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\DataStoreValueType;

class DoubleDataStoreValue extends DataStoreValue{

    public function __construct(
        public readonly float $value
    ){
        parent::__construct(DataStoreValueType::DOUBLE);
    }
}