<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Trim\TrimMaterial;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Trim\TrimPattern;

class TrimDataPacket implements Packet{

    public const ID = PacketIds::TRIM_DATA;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<TrimPattern> */
    public array $trimPatterns = [];

    /** @var list<TrimMaterial> */
    public array $trimMaterials = [];
}