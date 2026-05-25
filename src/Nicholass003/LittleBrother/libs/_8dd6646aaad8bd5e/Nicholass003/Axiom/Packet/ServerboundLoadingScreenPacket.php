<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum\LoadingScreenType;

class ServerboundLoadingScreenPacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_LOADING_SCREEN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public LoadingScreenType $type;

    public ?int $loadingScreenId;
}