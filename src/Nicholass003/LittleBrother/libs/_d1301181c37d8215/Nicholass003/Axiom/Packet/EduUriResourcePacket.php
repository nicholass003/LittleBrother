<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;

final class EduUriResourcePacket implements Packet{

    public const ID = PacketIds::EDU_URI_RESOURCE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public EducationUriResource $resource;
}