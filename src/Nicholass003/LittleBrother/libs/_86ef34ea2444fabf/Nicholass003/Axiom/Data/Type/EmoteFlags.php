<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\EmoteFlag;

final class EmoteFlags{

    private function __construct(
        private readonly int $flags
    ){}

    public static function fromInt(int $flags) : self{
        return new self($flags);
    }

    public function toInt() : int{
        return $this->flags;
    }

    public function hasServer() : bool{
        return $this->has(EmoteFlag::SERVER);
    }

    public function hasMuteAnnouncement() : bool{
        return $this->has(EmoteFlag::MUTE_ANNOUNCEMENT);
    }

    private function has(EmoteFlag $flag) : bool{
        return ($this->flags & $flag->value) !== 0;
    }
}