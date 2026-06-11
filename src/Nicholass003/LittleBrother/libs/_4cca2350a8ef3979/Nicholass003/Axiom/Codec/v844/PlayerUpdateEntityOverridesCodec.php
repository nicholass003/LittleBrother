<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum\OverrideUpdateType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\PlayerUpdateEntityOverridesPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class PlayerUpdateEntityOverridesCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerUpdateEntityOverridesPacket{
        $pk = new PlayerUpdateEntityOverridesPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->propertyIndex = VarInt::readUnsignedInt($in);
        $pk->updateType = OverrideUpdateType::safe(Byte::readUnsigned($in));

        if($pk->updateType === OverrideUpdateType::SET_INT_OVERRIDE){
            $pk->overrideValue = LE::readSignedInt($in);
        }elseif($pk->updateType === OverrideUpdateType::SET_FLOAT_OVERRIDE){
            $pk->overrideValue = LE::readFloat($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerUpdateEntityOverridesPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        VarInt::writeUnsignedInt($out, $pk->propertyIndex);
        Byte::writeUnsigned($out, $pk->updateType->value);

        if($pk->updateType === OverrideUpdateType::SET_INT_OVERRIDE){
            if(!is_int($pk->overrideValue)){
                throw new \LogicException("SET_INT_OVERRIDE requires int override value");
            }
            LE::writeSignedInt($out, $pk->overrideValue);
        }elseif($pk->updateType === OverrideUpdateType::SET_FLOAT_OVERRIDE){
            if(!is_float($pk->overrideValue)){
                throw new \LogicException("SET_FLOAT_OVERRIDE requires float override value");
            }
            LE::writeFloat($out, $pk->overrideValue);
        }
    }
}