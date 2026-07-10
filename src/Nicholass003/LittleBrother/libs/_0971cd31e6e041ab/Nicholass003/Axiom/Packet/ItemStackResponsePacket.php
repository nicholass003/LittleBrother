<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackResponse\ItemStackResponse;

class ItemStackResponsePacket implements Packet{

    public const ID = PacketIds::ITEM_STACK_RESPONSE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ItemStackResponse> */
    public array $responses = [];
}