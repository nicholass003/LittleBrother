<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\CommandRequestPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CommandRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CommandRequestPacket{
        $pk = new CommandRequestPacket();
        $pk->command = CodecHelper::readString($in);
        $pk->originData = $codec->command()->originData()->read($in);
        $pk->isInternal = CodecHelper::readBool($in);
        $pk->version = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CommandRequestPacket);
        CodecHelper::writeString($out, $pk->command);
        $codec->command()->originData()->write($out, $pk->originData);
        CodecHelper::writeBool($out, $pk->isInternal);
        VarInt::writeSignedInt($out, is_string($pk->version) ? 44 : $pk->version); //hardcode for now
    }
}