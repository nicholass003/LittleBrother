<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

final class CodeBuilderPacket implements Packet{

    public const ID = PacketIds::CODE_BUILDER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $url;
    public bool $openCodeBuilder;
}