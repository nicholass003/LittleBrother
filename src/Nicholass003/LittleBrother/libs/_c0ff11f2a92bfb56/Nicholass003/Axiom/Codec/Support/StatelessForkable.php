<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support;

trait StatelessForkable{

    public function fork() : static{
        return clone $this;
    }
}