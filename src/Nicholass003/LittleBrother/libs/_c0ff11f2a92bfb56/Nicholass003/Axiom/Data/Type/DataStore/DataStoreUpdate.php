<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\DataStore;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\DataStoreType;

class DataStoreUpdate extends DataStore{

    /** @since v924 */
    public readonly int $pathUpdateCount;

    public function __construct(
        public readonly string $name,
        public readonly string $property,
        public readonly string $path,
        public readonly DataStoreValue $data,
        public readonly int $updateCount,
        int $pathUpdateCount = 0
    ){
        parent::__construct(DataStoreType::UPDATE);
        $this->pathUpdateCount = $pathUpdateCount;
    }
}