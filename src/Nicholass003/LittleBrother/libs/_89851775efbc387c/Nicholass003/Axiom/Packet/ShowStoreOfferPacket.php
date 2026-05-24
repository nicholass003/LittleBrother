<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\ShowStoreOfferRedirectType;

class ShowStoreOfferPacket implements Packet{

    public const ID = PacketIds::SHOW_STORE_OFFER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $offerId;
    public ShowStoreOfferRedirectType $redirectType;
}