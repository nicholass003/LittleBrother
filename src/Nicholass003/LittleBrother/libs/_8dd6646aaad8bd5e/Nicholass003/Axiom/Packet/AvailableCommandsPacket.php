<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command\ChainedSubCommandRawData;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command\CommandEnumConstraintRawData;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command\CommandEnumRawData;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command\CommandRawData;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Command\CommandSoftEnum;

class AvailableCommandsPacket implements Packet{

    public const ID = PacketIds::AVAILABLE_COMMANDS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<string> */
    public array $enumValues = [];
    /** @var list<string> */
    public array $chainedSubCommandValues = [];
    /** @var list<string> */
    public array $postfixes = [];
    /** @var list<CommandEnumRawData> */
    public array $enums = [];
    /** @var list<ChainedSubCommandRawData> */
    public array $chainedSubCommandData = [];
    /** @var list<CommandRawData> */
    public array $commandData = [];
    /** @var list<CommandSoftEnum> */
    public array $softEnums = [];
    /** @var list<CommandEnumConstraintRawData> */
    public array $enumConstraints = [];
}