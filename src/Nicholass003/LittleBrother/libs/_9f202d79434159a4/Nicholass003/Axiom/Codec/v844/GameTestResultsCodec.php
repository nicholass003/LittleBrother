<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\GameTestResultsPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class GameTestResultsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : GameTestResultsPacket{
        $pk = new GameTestResultsPacket();
        $pk->success = CodecHelper::readBool($in);
        $pk->error = CodecHelper::readString($in);
        $pk->testName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof GameTestResultsPacket);
        CodecHelper::writeBool($out, $pk->success);
        CodecHelper::writeString($out, $pk->error);
        CodecHelper::writeString($out, $pk->testName);
    }
}