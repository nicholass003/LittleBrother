<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ServerboundDiagnosticsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerboundDiagnosticsPacket{
        $pk = new ServerboundDiagnosticsPacket();
        $pk->avgFps = LE::readFloat($in);
        $pk->avgServerSimTickTimeMS = LE::readFloat($in);
        $pk->avgClientSimTickTimeMS = LE::readFloat($in);
        $pk->avgBeginFrameTimeMS = LE::readFloat($in);
        $pk->avgInputTimeMS = LE::readFloat($in);
        $pk->avgRenderTimeMS = LE::readFloat($in);
        $pk->avgEndFrameTimeMS = LE::readFloat($in);
        $pk->avgRemainderTimePercent = LE::readFloat($in);
        $pk->avgUnaccountedTimePercent = LE::readFloat($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerboundDiagnosticsPacket);
        LE::writeFloat($out, $pk->avgFps);
        LE::writeFloat($out, $pk->avgServerSimTickTimeMS);
        LE::writeFloat($out, $pk->avgClientSimTickTimeMS);
        LE::writeFloat($out, $pk->avgBeginFrameTimeMS);
        LE::writeFloat($out, $pk->avgInputTimeMS);
        LE::writeFloat($out, $pk->avgRenderTimeMS);
        LE::writeFloat($out, $pk->avgEndFrameTimeMS);
        LE::writeFloat($out, $pk->avgRemainderTimePercent);
        LE::writeFloat($out, $pk->avgUnaccountedTimePercent);
    }
}