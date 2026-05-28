<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\PlayerLocationType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\PlayerLocationPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class PlayerLocationCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerLocationPacket{
        $pk = new PlayerLocationPacket();
        $pk->type = PlayerLocationType::safe(LE::readUnsignedInt($in));
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);

        if($pk->type === PlayerLocationType::COORDINATES){
            $pk->position = CodecHelper::readVec3($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerLocationPacket);
        LE::writeUnsignedInt($out, $pk->type->value);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);

        if($pk->type === PlayerLocationType::COORDINATES){
            if($pk->position === null){
                throw new \LogicException("PlayerLocationPacket with type COORDINATES requires a position");
            }
            CodecHelper::writeVec3($out, $pk->position);
        }
    }
}