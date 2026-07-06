<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support;

trait CloneWithProperty{

    protected function with(string $property, mixed $value) : static{
        $clone = clone $this;
        $clone->$property = $value;
        return $clone;
    }
}