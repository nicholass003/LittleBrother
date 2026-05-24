<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

class ChunkPosition{

    public function __construct(
        public readonly int $x,
        public readonly int $z
    ){}

    public function equals(self $other) : bool{
        return $this->x === $other->x && $this->z === $other->z;
    }

    public static function zero() : self{ return new self(0, 0); }
}