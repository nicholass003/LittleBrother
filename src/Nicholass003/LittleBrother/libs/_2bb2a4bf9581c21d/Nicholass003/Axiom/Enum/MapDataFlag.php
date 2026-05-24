<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum MapDataFlag : int{

    case TEXTURE_UPDATE = 0x02;
    case DECORATION_UPDATE = 0x04;
    case MAP_CREATION = 0x08;
}