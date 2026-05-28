<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support;

trait Forkable{

    public function fork() : static{
        /** @var static */
        return Forker::fork($this);
    }
}