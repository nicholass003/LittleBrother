<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

final class EditorNetworkPacket implements Packet{

    public const ID = PacketIds::EDITOR_NETWORK;
    public const RECIPIENT = PacketRecipient::BOTH;

    public bool $isRouteToManager;
    public string $nbtData; // binary NBT compound
}