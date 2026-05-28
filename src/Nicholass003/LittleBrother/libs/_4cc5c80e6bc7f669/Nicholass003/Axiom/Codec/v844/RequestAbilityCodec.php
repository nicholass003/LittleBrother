<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\RequestAbilityType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum\RequestAbilityValueType;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet\RequestAbilityPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class RequestAbilityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : RequestAbilityPacket{
        $pk = new RequestAbilityPacket();
        $pk->abilityId = RequestAbilityType::safe(VarInt::readSignedInt($in));

        $pk->valueType = $valueType = RequestAbilityValueType::safe(Byte::readUnsigned($in));
        $boolValue = CodecHelper::readBool($in);
        $floatValue = LE::readFloat($in);

        $pk->abilityValue = match($valueType){
            RequestAbilityValueType::BOOL => $boolValue,
            RequestAbilityValueType::FLOAT => $floatValue,
            default => throw new \RuntimeException("Unknown ability value type $valueType")
        };

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof RequestAbilityPacket);
        VarInt::writeSignedInt($out, $pk->abilityId->value);

        [$valueType, $boolValue, $floatValue] = match($pk->valueType){
            RequestAbilityValueType::BOOL => [$pk->valueType->value, $pk->abilityValue, 0.0],
            RequestAbilityValueType::FLOAT => [$pk->valueType->value, false, $pk->abilityValue],
            default => throw new \LogicException("Ability value must be bool or float")
        };
        Byte::writeUnsigned($out, $valueType);
        CodecHelper::writeBool($out, $boolValue, $floatValue);
        LE::writeFloat($out, $floatValue);
    }
}