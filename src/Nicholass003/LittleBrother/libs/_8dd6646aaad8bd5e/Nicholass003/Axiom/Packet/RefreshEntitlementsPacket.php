<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class RefreshEntitlementsPacket implements Packet{

    public const ID = PacketIds::REFRESH_ENTITLEMENTS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    // no fields
}