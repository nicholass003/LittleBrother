<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\AnimateEntityPacket;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class AnimateEntityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AnimateEntityPacket{
        $pk = new AnimateEntityPacket();
        $pk->animation = CodecHelper::readString($in);
        $pk->nextState = CodecHelper::readString($in);
        $pk->stopExpression = CodecHelper::readString($in);
        $pk->stopExpressionVersion = LE::readSignedInt($in);
        $pk->controller = CodecHelper::readString($in);
        $pk->blendOutTime = LE::readFloat($in);
        $count = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $count; ++$i){
            $pk->actorRuntimeIds[] = CodecHelper::readActorRuntimeId($in);
        }
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AnimateEntityPacket);
        CodecHelper::writeString($out, $pk->animation);
        CodecHelper::writeString($out, $pk->nextState);
        CodecHelper::writeString($out, $pk->stopExpression);
        LE::writeSignedInt($out, $pk->stopExpressionVersion);
        CodecHelper::writeString($out, $pk->controller);
        LE::writeFloat($out, $pk->blendOutTime);
        VarInt::writeUnsignedInt($out, count($pk->actorRuntimeIds));
        foreach($pk->actorRuntimeIds as $id){
            CodecHelper::writeActorRuntimeId($out, $id);
        }
    }
}