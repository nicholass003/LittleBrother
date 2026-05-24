<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data;

enum PacketRecipient : int{

    case CLIENT = 0;
    case SERVER = 1;
    case BOTH = 2;
}