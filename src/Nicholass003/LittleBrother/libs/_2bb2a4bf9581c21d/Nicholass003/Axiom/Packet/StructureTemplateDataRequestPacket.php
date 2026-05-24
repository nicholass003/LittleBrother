<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Structure\StructureSettings;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\StructureTemplateRequestType;

class StructureTemplateDataRequestPacket implements Packet{

    public const ID = PacketIds::STRUCTURE_TEMPLATE_DATA_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $structureTemplateName;
    public BlockPosition $structureBlockPosition;
    public StructureSettings $structureSettings;
    public StructureTemplateRequestType $requestType;
}