<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Command\CommandParameterRawData;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandParameterSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : CommandParameterRawData{
        return new CommandParameterRawData(
            CodecHelper::readString($in),
            LE::readUnsignedInt($in),
            CodecHelper::readBool($in),
            Byte::readUnsigned($in)
        );
    }

    public function write(ByteBufferWriter $out, CommandParameterRawData $param) : void{
        CodecHelper::writeString($out, $param->name);
        LE::writeUnsignedInt($out, $param->typeInfo);
        CodecHelper::writeBool($out, $param->optional);
        Byte::writeUnsigned($out, $param->flags);
    }

    /**
     * @return list<CommandParameterRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<CommandParameterRawData> $params
     */
    public function writeList(ByteBufferWriter $out, array $params) : void{
        CodecHelper::writeList($out, $params, fn($out, $p) => $this->write($out, $p));
    }
}