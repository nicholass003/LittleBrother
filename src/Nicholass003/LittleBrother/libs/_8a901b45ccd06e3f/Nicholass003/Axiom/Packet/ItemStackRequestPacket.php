<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequest;

class ItemStackRequestPacket implements Packet{

    public const ID = PacketIds::ITEM_STACK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    /** @var list<ItemStackRequest> */
    public array $requests = [];
}