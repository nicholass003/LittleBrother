<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\GameTestRotation;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\GameTestRequestPacket;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class GameTestRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : GameTestRequestPacket{
        $pk = new GameTestRequestPacket();
        $pk->maxTestsPerBatch = VarInt::readSignedInt($in);
        $pk->repeatCount = VarInt::readSignedInt($in);
        $pk->rotation = GameTestRotation::safe(Byte::readUnsigned($in));
        $pk->stopOnFailure = CodecHelper::readBool($in);
        $pk->testPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->testsPerRow = VarInt::readSignedInt($in);
        $pk->testName = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof GameTestRequestPacket);
        VarInt::writeSignedInt($out, $pk->maxTestsPerBatch);
        VarInt::writeSignedInt($out, $pk->repeatCount);
        Byte::writeUnsigned($out, $pk->rotation->value);
        CodecHelper::writeBool($out, $pk->stopOnFailure);
        CodecHelper::writeSignedBlockPosition($out, $pk->testPosition);
        VarInt::writeSignedInt($out, $pk->testsPerRow);
        CodecHelper::writeString($out, $pk->testName);
    }
}