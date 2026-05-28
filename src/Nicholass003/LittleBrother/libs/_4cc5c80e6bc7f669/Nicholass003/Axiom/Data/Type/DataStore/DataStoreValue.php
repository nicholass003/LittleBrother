<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\DataStoreValueType;

abstract class DataStoreValue{

    public function __construct(
        public readonly DataStoreValueType $type
    ){}
}