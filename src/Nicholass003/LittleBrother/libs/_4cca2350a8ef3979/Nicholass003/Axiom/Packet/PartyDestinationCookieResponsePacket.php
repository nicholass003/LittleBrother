<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;

/** @since v1001 */
class PartyDestinationCookieResponsePacket implements Packet{

    public const ID = PacketIds::PARTY_DESTINATION_COOKIE_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $cookie = '';
    public bool $accepted = false;
}