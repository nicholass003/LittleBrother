<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\StructureTemplateResponseType;

class StructureTemplateDataResponsePacket implements Packet{

    public const ID = PacketIds::STRUCTURE_TEMPLATE_DATA_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $structureTemplateName;
    public ?string $nbt = null; // Raw NBT binary, nullable
    public StructureTemplateResponseType $responseType;
}