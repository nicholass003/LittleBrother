<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\BlockPosition;

class LecternUpdatePacket implements Packet{

    public const ID = PacketIds::LECTERN_UPDATE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $page;
    public int $totalPages;
    public BlockPosition $blockPosition;
}