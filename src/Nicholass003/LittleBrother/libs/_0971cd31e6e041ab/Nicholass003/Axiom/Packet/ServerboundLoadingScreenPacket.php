<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\LoadingScreenType;

class ServerboundLoadingScreenPacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_LOADING_SCREEN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public LoadingScreenType $type;

    public ?int $loadingScreenId;
}