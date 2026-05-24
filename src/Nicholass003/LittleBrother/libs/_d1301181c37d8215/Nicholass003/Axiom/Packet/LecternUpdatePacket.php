<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\BlockPosition;

class LecternUpdatePacket implements Packet{

    public const ID = PacketIds::LECTERN_UPDATE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $page;
    public int $totalPages;
    public BlockPosition $blockPosition;
}