<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data;

enum PacketRecipient : int{

    case CLIENT = 0;
    case SERVER = 1;
    case BOTH = 2;
}