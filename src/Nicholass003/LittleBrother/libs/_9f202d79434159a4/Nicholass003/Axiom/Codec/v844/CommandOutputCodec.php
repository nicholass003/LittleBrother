<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum\CommandOutputType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\CommandOutputPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CommandOutputCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CommandOutputPacket{
        $pk = new CommandOutputPacket();
        $pk->originData = $codec->command()->originData()->read($in);
        $pk->outputType = CommandOutputType::safe(Byte::readUnsigned($in));
        $pk->successCount = VarInt::readUnsignedInt($in);
        $pk->messages = $codec->command()->outputMessage()->readList($in);

        if($pk->outputType === CommandOutputType::DATA_SET){
            $pk->unknownString = CodecHelper::readString($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CommandOutputPacket);
        $codec->command()->originData()->write($out, $pk->originData);
        Byte::writeUnsigned($out, $pk->outputType->value);
        VarInt::writeUnsignedInt($out, $pk->successCount);
        $codec->command()->outputMessage()->writeList($out, $pk->messages);

        if($pk->outputType === CommandOutputType::DATA_SET){
            CodecHelper::writeString($out, $pk->unknownString);
        }
    }
}