<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type;

class Vec2{

    public function __construct(
        public readonly float $x,
        public readonly float $y
    ){}

    public function equals(self $other) : bool{
        return $this->x === $other->x && $this->y === $other->y;
    }

    public static function zero() : self{ return new self(0.0, 0.0); }
}