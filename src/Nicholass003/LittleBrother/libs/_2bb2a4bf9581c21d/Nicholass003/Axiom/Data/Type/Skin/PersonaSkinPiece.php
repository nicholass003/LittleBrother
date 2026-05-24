<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Skin;

class PersonaSkinPiece{

    public function __construct(
        public readonly string $pieceId,
        public readonly string $pieceType,
        public readonly string $packId,
        public readonly bool $isDefaultPiece,
        public readonly string $productId
    ){}
}