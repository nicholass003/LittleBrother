<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum;

enum ScorePacketEntryType : int{

    case UNKNOWN = 0;
    case PLAYER = 1;
    case ENTITY = 2;
    case FAKE_PLAYER = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}