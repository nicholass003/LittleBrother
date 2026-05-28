<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\MoveActorDeltaFlag;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\MoveActorDeltaPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class MoveActorDeltaCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MoveActorDeltaPacket{
        $pk = new MoveActorDeltaPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->flags = LE::readUnsignedShort($in);

        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_X)){
            $pk->xPos = LE::readFloat($in);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_Y)){
            $pk->yPos = LE::readFloat($in);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_Z)){
            $pk->zPos = LE::readFloat($in);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_PITCH)){
            $pk->pitch = CodecHelper::readRotationByte($in);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_YAW)){
            $pk->yaw = CodecHelper::readRotationByte($in);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_HEAD_YAW)){
            $pk->headYaw = CodecHelper::readRotationByte($in);
        }

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MoveActorDeltaPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        LE::writeUnsignedShort($out, $pk->flags);

        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_X)){
            LE::writeFloat($out, $pk->xPos);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_Y)){
            LE::writeFloat($out, $pk->yPos);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_Z)){
            LE::writeFloat($out, $pk->zPos);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_PITCH)){
            CodecHelper::writeRotationByte($out, $pk->pitch);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_YAW)){
            CodecHelper::writeRotationByte($out, $pk->yaw);
        }
        if($this->hasFlag($pk->flags, MoveActorDeltaFlag::HAS_HEAD_YAW)){
            CodecHelper::writeRotationByte($out, $pk->headYaw);
        }
    }

    private function hasFlag(int $flags, MoveActorDeltaFlag $flag) : bool{
        return ($flags & $flag->value) !== 0;
    }
}