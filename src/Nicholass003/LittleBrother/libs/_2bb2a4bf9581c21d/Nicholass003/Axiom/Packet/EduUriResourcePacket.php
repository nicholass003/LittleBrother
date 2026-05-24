<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;

final class EduUriResourcePacket implements Packet{

    public const ID = PacketIds::EDU_URI_RESOURCE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public EducationUriResource $resource;
}