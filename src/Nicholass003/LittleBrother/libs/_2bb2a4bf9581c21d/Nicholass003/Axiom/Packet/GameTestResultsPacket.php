<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class GameTestResultsPacket implements Packet{

    public const ID = PacketIds::GAME_TEST_RESULTS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $success;
    public string $error;
    public string $testName;
}