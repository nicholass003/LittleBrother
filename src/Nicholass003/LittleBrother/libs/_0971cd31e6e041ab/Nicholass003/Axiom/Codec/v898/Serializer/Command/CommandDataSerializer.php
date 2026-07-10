<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v898\Serializer\Command;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandDataSerializer as BaseCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOverloadSerializer;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Command\CommandRawData;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\CommandPermissions;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandDataSerializer extends BaseCommandDataSerializer{

    public function __construct(
        private CommandOverloadSerializer $overloadSerializer
    ){}

    public function overload() : CommandOverloadSerializer{ return $this->overloadSerializer; }

    public function withOverload(CommandOverloadSerializer $v) : self{ return $this->with('overloadSerializer', $v); }

    public function read(ByteBufferReader $in) : CommandRawData{
        $name = CodecHelper::readString($in);
        $description = CodecHelper::readString($in);
        $flags = LE::readUnsignedShort($in);
        $permission = CommandPermissions::fromString(CodecHelper::readString($in));
        $aliasEnumIndex = LE::readSignedInt($in);

        $chainedIndexes = CodecHelper::readList($in, fn($in) => LE::readUnsignedShort($in));
        $overloads = $this->overloadSerializer->readList($in);

        return new CommandRawData($name, $description, $flags, $permission, $aliasEnumIndex, $chainedIndexes, $overloads);
    }

    public function write(ByteBufferWriter $out, CommandRawData $data) : void{
        CodecHelper::writeString($out, $data->name);
        CodecHelper::writeString($out, $data->description);
        LE::writeUnsignedShort($out, $data->flags);
        CodecHelper::writeString($out, $data->permission->toString());
        LE::writeSignedInt($out, $data->aliasEnumIndex);

        CodecHelper::writeList($out, $data->chainedSubCommandDataIndexes, fn($out, $idx) => LE::writeUnsignedShort($out, $idx));
        $this->overloadSerializer->writeList($out, $data->overloads);
    }

    /**
     * @return list<CommandRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<CommandRawData> $data
     */
    public function writeList(ByteBufferWriter $out, array $data) : void{
        CodecHelper::writeList($out, $data, fn($out, $d) => $this->write($out, $d));
    }
}