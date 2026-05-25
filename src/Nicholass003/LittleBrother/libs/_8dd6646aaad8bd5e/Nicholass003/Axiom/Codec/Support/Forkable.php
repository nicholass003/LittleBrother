<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support;

trait Forkable{

    public function fork() : static{
        /** @var static */
        return Forker::fork($this);
    }
}