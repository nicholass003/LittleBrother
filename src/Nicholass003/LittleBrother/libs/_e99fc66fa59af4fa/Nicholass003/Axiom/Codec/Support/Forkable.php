<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support;

trait Forkable{

    public function fork() : static{
        /** @var static */
        return Forker::fork($this);
    }
}