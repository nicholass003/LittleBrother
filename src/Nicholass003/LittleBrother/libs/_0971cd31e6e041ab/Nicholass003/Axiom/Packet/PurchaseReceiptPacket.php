<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class PurchaseReceiptPacket implements Packet{

    public const ID = PacketIds::PURCHASE_RECEIPT;
    public const RECIPIENT = PacketRecipient::SERVER;

    /** @var list<string> */
    public array $entries = [];
}