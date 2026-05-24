<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Skin;

class PersonaPieceTintColor{

    /**
     * @param string[] $colors
     */
    public function __construct(
        public readonly string $pieceType,
        public readonly array $colors
    ){}
}