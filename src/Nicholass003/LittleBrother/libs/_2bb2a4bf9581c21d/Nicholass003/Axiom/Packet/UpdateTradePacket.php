<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\WindowTypes;

class UpdateTradePacket implements Packet{

    public const ID = PacketIds::UPDATE_TRADE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $windowId;
    public WindowTypes $windowType = WindowTypes::TRADING;
    public int $windowSlotCount = 0;
    public int $tradeTier;
    public int $traderActorUniqueId;
    public int $playerActorUniqueId;
    public string $displayName;
    public bool $isV2Trading;
    public bool $isEconomyTrading;
    public string $offers; // Raw NBT binary
}