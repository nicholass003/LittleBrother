<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v859;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\AnimateAction;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class AnimateCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : AnimatePacket{
        $pk = new AnimatePacket();
        $pk->action = AnimateAction::safe(VarInt::readSignedInt($in));
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);

        $pk->data = LE::readFloat($in);

        if($pk->action === AnimateAction::ROW_LEFT || $pk->action === AnimateAction::ROW_RIGHT){
            $pk->rowingTime = LE::readFloat($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof AnimatePacket);

        VarInt::writeSignedInt($out, $pk->action->value);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);

        LE::writeFloat($out, $pk->data);

        if($pk->action === AnimateAction::ROW_LEFT || $pk->action === AnimateAction::ROW_RIGHT){
            LE::writeFloat($out, $pk->rowingTime ?? 0.0);
        }
    }
}