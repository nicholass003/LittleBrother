<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\PlayerVideoCapturePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class PlayerVideoCaptureCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerVideoCapturePacket{
        $pk = new PlayerVideoCapturePacket();
        $pk->recording = CodecHelper::readBool($in);
        if($pk->recording){
            $pk->frameRate = LE::readUnsignedInt($in);
            $pk->filePrefix = CodecHelper::readString($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerVideoCapturePacket);
        CodecHelper::writeBool($out, $pk->recording);
        if($pk->recording){
            if($pk->frameRate === null || $pk->filePrefix === null){
                throw new \LogicException("Recording requires frameRate and filePrefix");
            }
            LE::writeUnsignedInt($out, $pk->frameRate);
            CodecHelper::writeString($out, $pk->filePrefix);
        }
    }
}