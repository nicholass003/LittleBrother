<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Structure\StructureEditorData;

class StructureBlockUpdatePacket implements Packet{

    public const ID = PacketIds::STRUCTURE_BLOCK_UPDATE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BlockPosition $blockPosition;
    public StructureEditorData $structureEditorData;
    public bool $isPowered;
    public bool $waterlogged;
}