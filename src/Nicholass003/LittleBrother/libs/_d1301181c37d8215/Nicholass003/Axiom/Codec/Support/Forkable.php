<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support;

trait Forkable{

    public function fork() : static{
        /** @var static */
        return Forker::fork($this);
    }
}