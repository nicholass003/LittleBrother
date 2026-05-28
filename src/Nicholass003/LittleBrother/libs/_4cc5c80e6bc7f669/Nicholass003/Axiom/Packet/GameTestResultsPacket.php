<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class GameTestResultsPacket implements Packet{

    public const ID = PacketIds::GAME_TEST_RESULTS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $success;
    public string $error;
    public string $testName;
}