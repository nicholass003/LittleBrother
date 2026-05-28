<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

final class CodeBuilderSourcePacket implements Packet{

    public const ID = PacketIds::CODE_BUILDER_SOURCE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $operation;
    public int $category;
    public int $codeStatus;
}