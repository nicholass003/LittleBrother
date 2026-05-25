<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequest;

class ItemStackRequestPacket implements Packet{

    public const ID = PacketIds::ITEM_STACK_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    /** @var list<ItemStackRequest> */
    public array $requests = [];
}