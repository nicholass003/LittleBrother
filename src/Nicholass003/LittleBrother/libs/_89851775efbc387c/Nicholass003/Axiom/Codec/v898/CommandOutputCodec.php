<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v898;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v898\Serializer\Command\CommandOriginDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\CommandOutputType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\CommandOutputPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandOutputCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CommandOutputPacket{
        $originData = $codec->command()->originData();
        assert($originData instanceof CommandOriginDataSerializer);
        $pk = new CommandOutputPacket();
        $pk->originData = $originData->read($in);
        $rawType = CodecHelper::readString($in);
        $pk->outputType = CommandOutputType::fromString($rawType);
        $pk->successCount = LE::readUnsignedInt($in);
        $pk->messages = $codec->command()->outputMessage()->readList($in);
        $pk->data = CodecHelper::readOptional($in, CodecHelper::readString(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CommandOutputPacket);
        $originData = $codec->command()->originData();
        assert($originData instanceof CommandOriginDataSerializer);
        $originData->write($out, $pk->originData);
        CodecHelper::writeString($out, $pk->outputType->toString());
        LE::writeUnsignedInt($out, $pk->successCount);
        $codec->command()->outputMessage()->writeList($out, $pk->messages);
        CodecHelper::writeOptional($out, $pk->data, CodecHelper::writeString(...));
    }
}