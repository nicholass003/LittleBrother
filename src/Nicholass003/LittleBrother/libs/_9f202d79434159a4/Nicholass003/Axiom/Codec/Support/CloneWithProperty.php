<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support;

trait CloneWithProperty{

    protected function with(string $property, mixed $value) : static{
        $clone = clone $this;
        $clone->$property = $value;
        return $clone;
    }
}