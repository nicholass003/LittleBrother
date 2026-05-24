<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support;

trait StatelessForkable{

    public function fork() : static{
        return clone $this;
    }
}