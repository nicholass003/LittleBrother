<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Biome\BiomeDefinitionData;

class BiomeDefinitionListPacket implements Packet{
    
    public const ID = PacketIds::BIOME_DEFINITION_LIST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<BiomeDefinitionData> */
    public array $definitionData = [];
    /** @var list<string> */
    public array $strings = [];
}