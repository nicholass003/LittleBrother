<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\BiomeDefinitionData;

class BiomeDefinitionListPacket implements Packet{
    
    public const ID = PacketIds::BIOME_DEFINITION_LIST;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<BiomeDefinitionData> */
    public array $definitionData = [];
    /** @var list<string> */
    public array $strings = [];
}