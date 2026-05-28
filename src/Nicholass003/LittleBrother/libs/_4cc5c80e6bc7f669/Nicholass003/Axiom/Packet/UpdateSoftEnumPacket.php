<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\UpdateSoftEnumType;

class UpdateSoftEnumPacket implements Packet{

    public const ID = PacketIds::UPDATE_SOFT_ENUM;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $enumName;
    /** @var list<string> */
    public array $values = [];
    public UpdateSoftEnumType $type;
}