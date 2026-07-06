<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v1001;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Graphics\ParameterKeyframeValue;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\GraphicsOverrideParameterType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\GraphicsOverrideParameterPacket;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class GraphicsOverrideParameterCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : GraphicsOverrideParameterPacket{
        $pk = new GraphicsOverrideParameterPacket();

        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $time = LE::readFloat($in);
            $value = CodecHelper::readVec3($in);
            $pk->values[] = new ParameterKeyframeValue($time, $value);
        }

        $pk->unknownFloat = CodecHelper::readOptional($in, LE::readFloat(...));
        $pk->unknownVec3 = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        $pk->biomeIdentifier = CodecHelper::readString($in);
        $pk->playerIdentifier = CodecHelper::readString($in);
        $pk->parameterType = GraphicsOverrideParameterType::safe(Byte::readUnsigned($in));
        $pk->reset = CodecHelper::readBool($in);

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof GraphicsOverrideParameterPacket);

        VarInt::writeUnsignedInt($out, count($pk->values));
        foreach($pk->values as $value){
            LE::writeFloat($out, $value->time);
            CodecHelper::writeVec3($out, $value->value);
        }

        CodecHelper::writeOptional($out, $pk->unknownFloat, LE::writeFloat(...));
        CodecHelper::writeOptional($out, $pk->unknownVec3, CodecHelper::writeVec3(...));
        CodecHelper::writeString($out, $pk->biomeIdentifier);
        CodecHelper::writeString($out, $pk->playerIdentifier);
        Byte::writeUnsigned($out, $pk->parameterType->value);
        CodecHelper::writeBool($out, $pk->reset);
    }
}