<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

class Vec3{

    public function __construct(
        public readonly float $x,
        public readonly float $y,
        public readonly float $z
    ){}

    public function equals(self $other) : bool{
        return $this->x === $other->x && $this->y === $other->y && $this->z === $other->z;
    }

    public static function zero() : self{ return new self(0.0, 0.0, 0.0); }
}