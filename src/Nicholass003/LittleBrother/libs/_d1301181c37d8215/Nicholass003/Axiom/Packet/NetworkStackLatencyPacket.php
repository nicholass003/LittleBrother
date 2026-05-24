<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class NetworkStackLatencyPacket implements Packet{

    public const ID = PacketIds::NETWORK_STACK_LATENCY;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $timestamp;
    public bool $needResponse;
}