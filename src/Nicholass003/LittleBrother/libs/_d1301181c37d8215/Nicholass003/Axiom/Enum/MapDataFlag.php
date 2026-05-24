<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum MapDataFlag : int{

    case TEXTURE_UPDATE = 0x02;
    case DECORATION_UPDATE = 0x04;
    case MAP_CREATION = 0x08;
}