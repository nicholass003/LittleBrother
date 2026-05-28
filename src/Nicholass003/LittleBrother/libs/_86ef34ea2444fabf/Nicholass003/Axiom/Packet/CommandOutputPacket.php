<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Command\CommandOriginData;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Command\CommandOutputMessage;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\CommandOutputType;

final class CommandOutputPacket implements Packet{

    public const ID = PacketIds::COMMAND_OUTPUT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public CommandOriginData $originData;
    public CommandOutputType $outputType;
    public int $successCount;
    /** @var list<CommandOutputMessage> */
    public array $messages = [];
    /** @deprecated v898 */
    public string $unknownString;
    public ?string $data;
}