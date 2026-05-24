<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;

class LecternUpdatePacket implements Packet{

    public const ID = PacketIds::LECTERN_UPDATE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $page;
    public int $totalPages;
    public BlockPosition $blockPosition;
}