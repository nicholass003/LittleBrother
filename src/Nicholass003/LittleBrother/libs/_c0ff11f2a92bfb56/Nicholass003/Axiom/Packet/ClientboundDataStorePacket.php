<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\DataStore\DataStore;

/** @since v859 */
class ClientboundDataStorePacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_DATA_STORE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<DataStore> */
    public array $values = [];
}