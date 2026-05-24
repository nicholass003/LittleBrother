<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\NetworkSettingsPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class NetworkSettingsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : NetworkSettingsPacket{
        $pk = new NetworkSettingsPacket();
        $pk->compressionThreshold = LE::readUnsignedShort($in);
        $pk->compressionAlgorithm = LE::readUnsignedShort($in);
        $pk->enableClientThrottling = CodecHelper::readBool($in);
        $pk->clientThrottleThreshold = Byte::readUnsigned($in);
        $pk->clientThrottleScalar = LE::readFloat($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof NetworkSettingsPacket);
        LE::writeUnsignedShort($out, $pk->compressionThreshold);
        LE::writeUnsignedShort($out, $pk->compressionAlgorithm);
        CodecHelper::writeBool($out, $pk->enableClientThrottling);
        Byte::writeUnsigned($out, $pk->clientThrottleThreshold);
        LE::writeFloat($out, $pk->clientThrottleScalar);
    }
}