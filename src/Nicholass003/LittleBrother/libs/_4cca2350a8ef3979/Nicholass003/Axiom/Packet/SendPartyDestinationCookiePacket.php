<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\PartyDestinationCookieIntent;

/** @since v1001 */
class SendPartyDestinationCookiePacket implements Packet{

    public const ID = PacketIds::SEND_PARTY_DESTINATION_COOKIE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $cookie = '';
    public PartyDestinationCookieIntent $intent = PartyDestinationCookieIntent::UNKNOWN;
    public string $destinationName = '';
}