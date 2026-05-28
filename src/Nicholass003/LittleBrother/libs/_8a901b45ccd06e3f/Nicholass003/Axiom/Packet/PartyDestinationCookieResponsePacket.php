<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

/** @since v1001 */
class PartyDestinationCookieResponsePacket implements Packet{

    public const ID = PacketIds::PARTY_DESTINATION_COOKIE_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $cookie = '';
    public bool $accepted = false;
}