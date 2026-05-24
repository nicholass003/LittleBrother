<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class PartyChangedPacket implements Packet{

    public const ID = PacketIds::PARTY_CHANGED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $partyId = '';
    /** @since v975 */
    public bool $partyLeader = false;
}