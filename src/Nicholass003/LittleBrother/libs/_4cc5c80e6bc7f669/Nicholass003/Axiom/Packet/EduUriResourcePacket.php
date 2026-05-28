<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;

final class EduUriResourcePacket implements Packet{

    public const ID = PacketIds::EDU_URI_RESOURCE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public EducationUriResource $resource;
}