<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

final class EditorNetworkPacket implements Packet{

    public const ID = PacketIds::EDITOR_NETWORK;
    public const RECIPIENT = PacketRecipient::BOTH;

    public bool $isRouteToManager;
    public string $nbtData; // binary NBT compound
}