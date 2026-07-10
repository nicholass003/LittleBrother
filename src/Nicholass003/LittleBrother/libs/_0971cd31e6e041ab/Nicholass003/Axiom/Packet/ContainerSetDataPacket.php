<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

final class ContainerSetDataPacket implements Packet{

    public const ID = PacketIds::CONTAINER_SET_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public const PROPERTY_FURNACE_SMELT_PROGRESS = 0;
    public const PROPERTY_FURNACE_REMAINING_FUEL_TIME = 1;
    public const PROPERTY_FURNACE_MAX_FUEL_TIME = 2;
    public const PROPERTY_FURNACE_STORED_XP = 3;
    public const PROPERTY_FURNACE_FUEL_AUX = 4;

    public const PROPERTY_BREWING_STAND_BREW_TIME = 0;
    public const PROPERTY_BREWING_STAND_FUEL_AMOUNT = 1;
    public const PROPERTY_BREWING_STAND_FUEL_TOTAL = 2;

    public int $windowId;
    public int $property;
    public int $value;
}