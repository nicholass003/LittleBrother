<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

class PartyChangedPacket implements Packet{

    public const ID = PacketIds::PARTY_CHANGED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $partyId = '';
    /** @since v975 */
    public bool $partyLeader = false;
}