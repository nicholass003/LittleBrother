<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\NpcDialogueAction;

class NpcDialoguePacket implements Packet{

    public const ID = PacketIds::NPC_DIALOGUE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $npcActorUniqueId;
    public NpcDialogueAction $actionType;
    public string $dialogue;
    public string $sceneName;
    public string $npcName;
    public string $actionJson;
}