<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\GameTestRotation;

class GameTestRequestPacket implements Packet{

    public const ID = PacketIds::GAME_TEST_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $maxTestsPerBatch;
    public int $repeatCount;
    public GameTestRotation $rotation;
    public bool $stopOnFailure;
    public BlockPosition $testPosition;
    public int $testsPerRow;
    public string $testName;
}