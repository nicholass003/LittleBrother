<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\DataStore\DataStoreUpdate;

class ServerboundDataStorePacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_DATA_STORE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public DataStoreUpdate $update;
}