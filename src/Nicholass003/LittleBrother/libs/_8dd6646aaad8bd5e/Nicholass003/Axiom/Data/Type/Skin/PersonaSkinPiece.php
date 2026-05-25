<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Skin;

class PersonaSkinPiece{

    public function __construct(
        public readonly string $pieceId,
        public readonly string $pieceType,
        public readonly string $packId,
        public readonly bool $isDefaultPiece,
        public readonly string $productId
    ){}
}