<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\BlockPosition;

final class CommandBlockUpdatePacket implements Packet{

    public const ID = PacketIds::COMMAND_BLOCK_UPDATE;
    public const RECIPIENT = PacketRecipient::SERVER;

    public bool $isBlock;
    public BlockPosition $blockPosition;
    public int $commandBlockMode;
    public bool $isRedstoneMode;
    public bool $isConditional;
    public int $minecartActorRuntimeId;
    public string $command;
    public string $lastOutput;
    public string $name;
    public string $filteredName;
    public bool $shouldTrackOutput;
    public int $tickDelay;
    public bool $executeOnFirstTick;
}