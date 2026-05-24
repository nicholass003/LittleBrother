<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class JigsawStructureDataPacket implements Packet{

    public const ID = PacketIds::JIGSAW_STRUCTURE_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $nbt; // Raw NBT binary
}