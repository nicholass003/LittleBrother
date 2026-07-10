<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\GameRule;

class GameRulesChangedPacket implements Packet{

    public const ID = PacketIds::GAME_RULES_CHANGED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var array<string, GameRule> */
    public array $gameRules = [];
}