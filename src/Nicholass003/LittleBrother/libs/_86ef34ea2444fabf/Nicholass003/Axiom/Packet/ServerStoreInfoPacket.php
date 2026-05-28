<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\ClientStoreEntrypointConfig;

/** @since v975 */
class ServerStoreInfoPacket implements Packet{

    public const ID = PacketIds::SERVER_STORE_INFO;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ?ClientStoreEntrypointConfig $clientStoreEntrypointConfig = null;
}