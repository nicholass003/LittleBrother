<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Command\CommandRawData;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\CommandPermissions;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandDataSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private CommandOverloadSerializer $overloadSerializer
    ){}

    public function overload() : CommandOverloadSerializer{ return $this->overloadSerializer; }

    public function withOverload(CommandOverloadSerializer $v) : self{ return $this->with('overloadSerializer', $v); }

    public function read(ByteBufferReader $in) : CommandRawData{
        $name = CodecHelper::readString($in);
        $description = CodecHelper::readString($in);
        $flags = LE::readUnsignedShort($in);
        $permission = CommandPermissions::safe(Byte::readUnsigned($in));
        $aliasEnumIndex = LE::readSignedInt($in);

        $chainedIndexes = CodecHelper::readList($in, fn($in) => LE::readUnsignedShort($in));
        $overloads = $this->overloadSerializer->readList($in);

        return new CommandRawData($name, $description, $flags, $permission, $aliasEnumIndex, $chainedIndexes, $overloads);
    }

    public function write(ByteBufferWriter $out, CommandRawData $data) : void{
        CodecHelper::writeString($out, $data->name);
        CodecHelper::writeString($out, $data->description);
        LE::writeUnsignedShort($out, $data->flags);
        Byte::writeUnsigned($out, $data->permission->value);
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