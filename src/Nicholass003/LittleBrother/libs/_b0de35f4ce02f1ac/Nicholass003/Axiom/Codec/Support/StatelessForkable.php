<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support;

trait StatelessForkable{

    public function fork() : static{
        return clone $this;
    }
}