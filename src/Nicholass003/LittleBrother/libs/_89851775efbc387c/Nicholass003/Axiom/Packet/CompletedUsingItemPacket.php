<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

final class CompletedUsingItemPacket implements Packet{

    public const ID = PacketIds::COMPLETED_USING_ITEM;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public const ACTION_EQUIP_ARMOR = 0;
    public const ACTION_EAT = 1;
    public const ACTION_ATTACK = 2;
    public const ACTION_CONSUME = 3;
    public const ACTION_THROW = 4;
    public const ACTION_SHOOT = 5;
    public const ACTION_PLACE = 6;
    public const ACTION_FILL_BOTTLE = 7;
    public const ACTION_FILL_BUCKET = 8;
    public const ACTION_POUR_BUCKET = 9;
    public const ACTION_USE_TOOL = 10;
    public const ACTION_INTERACT = 11;
    public const ACTION_RETRIEVED = 12;
    public const ACTION_DYED = 13;
    public const ACTION_TRADED = 14;
    public const ACTION_BRUSHING_COMPLETED = 15;

    public int $itemId;
    public int $action;
}