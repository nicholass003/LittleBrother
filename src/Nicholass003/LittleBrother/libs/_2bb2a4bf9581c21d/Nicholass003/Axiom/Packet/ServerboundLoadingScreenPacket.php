<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\LoadingScreenType;

class ServerboundLoadingScreenPacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_LOADING_SCREEN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public LoadingScreenType $type;

    public ?int $loadingScreenId;
}