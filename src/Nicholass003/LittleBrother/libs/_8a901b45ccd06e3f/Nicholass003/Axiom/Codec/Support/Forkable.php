<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support;

trait Forkable{

    public function fork() : static{
        /** @var static */
        return Forker::fork($this);
    }
}