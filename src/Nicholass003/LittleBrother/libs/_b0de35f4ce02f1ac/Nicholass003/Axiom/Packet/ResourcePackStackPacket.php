<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Experiments;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\ResourcePack\ResourcePackStackEntry;

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