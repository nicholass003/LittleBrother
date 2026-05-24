<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support;

trait StatelessForkable{

    public function fork() : static{
        return clone $this;
    }
}