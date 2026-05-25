<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Skin;

class PersonaSkinPiece{

    public function __construct(
        public readonly string $pieceId,
        public readonly string $pieceType,
        public readonly string $packId,
        public readonly bool $isDefaultPiece,
        public readonly string $productId
    ){}
}