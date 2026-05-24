<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support;

trait StatelessForkable{

    public function fork() : static{
        return clone $this;
    }
}