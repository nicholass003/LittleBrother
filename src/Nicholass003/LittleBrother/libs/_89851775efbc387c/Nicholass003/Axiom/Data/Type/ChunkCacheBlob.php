<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type;

final class ChunkCacheBlob{

    public function __construct(
        public readonly int $hash,
        public readonly string $payload
    ){}
}