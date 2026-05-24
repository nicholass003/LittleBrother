<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Experiments;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\ResourcePack\ResourcePackStackEntry;

class ResourcePackStackPacket implements Packet{

    public const ID = PacketIds::RESOURCE_PACK_STACK;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var ResourcePackStackEntry[] */
    public array $resourcePackStack = [];

    /** 
     * @deprecated v898
     * @var ResourcePackStackEntry[]
     */
    public array $behaviorPackStack = [];

    public bool $mustAccept;
    public string $baseGameVersion;

    public Experiments $experiments;

    public bool $useVanillaEditorPacks;
}