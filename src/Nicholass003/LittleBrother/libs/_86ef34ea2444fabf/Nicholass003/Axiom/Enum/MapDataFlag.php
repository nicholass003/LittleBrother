<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum;

enum MapDataFlag : int{

    case TEXTURE_UPDATE = 0x02;
    case DECORATION_UPDATE = 0x04;
    case MAP_CREATION = 0x08;
}