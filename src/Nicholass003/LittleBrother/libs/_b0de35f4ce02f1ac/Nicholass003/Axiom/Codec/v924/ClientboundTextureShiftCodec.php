<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v924;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\TextureShiftAction;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\ClientboundTextureShiftPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ClientboundTextureShiftCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientboundTextureShiftPacket{
        $pk = new ClientboundTextureShiftPacket();
        $pk->action = TextureShiftAction::safe(Byte::readUnsigned($in));
        $pk->collectionName = CodecHelper::readString($in);
        $pk->fromStep = CodecHelper::readString($in);
        $pk->toStep = CodecHelper::readString($in);
        $pk->allSteps = CodecHelper::readList($in, CodecHelper::readString(...));
        $pk->currentLengthTicks = VarInt::readUnsignedLong($in);
        $pk->totalLengthTicks = VarInt::readUnsignedLong($in);
        $pk->enabled = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientboundTextureShiftPacket);
        Byte::writeUnsigned($out, $pk->action->value);
        CodecHelper::writeString($out, $pk->collectionName);
        CodecHelper::writeString($out, $pk->fromStep);
        CodecHelper::writeString($out, $pk->toStep);
        CodecHelper::writeList($out, $pk->allSteps, CodecHelper::writeString(...));
    }
}