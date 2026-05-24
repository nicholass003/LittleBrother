<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

final class CurrentStructureFeaturePacket implements Packet{

    public const ID = PacketIds::CURRENT_STRUCTURE_FEATURE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $currentStructureFeature;
}